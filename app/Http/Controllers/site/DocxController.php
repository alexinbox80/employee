<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Services\Contracts\EmployeeContract;
use DateTime;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\JcTable;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocxController extends Controller
{

    public function __construct(
        private readonly EmployeeContract $employeeService,
    )
    {
    }

    function m2t(int $millimeters): float
    {
        return floor($millimeters * 56.7); //1 твип равен 1/567 сантиметра
    }

    function areDatesConsecutive(string $date1, string $date2): bool
    {
        $firstDate = new DateTime($date1);
        $secondDate = new DateTime($date2);

        $diff = $firstDate->diff($secondDate);
        return abs($diff->days) === 1;
    }

    public function generate(Request $request): BinaryFileResponse
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $employees = $this->employeeService->indexDocx($month, $year);

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $sectionStyle = [
            'orientation' => 'portrait',
            'marginLeft' => $this->m2t(15), //Левое поле равно 15 мм
            'marginRight' => $this->m2t(15),
            'marginTop' => $this->m2t(15),
            'borderTopColor' => 'C0C0C0'
        ];
        $section = $phpWord->addSection($sectionStyle);

        // Add text
        $cornerStamp = ['size' => 14, 'bold' => true];
        $conerStampPosition = [
            'space' => ['before' => 0, 'after' => 0],
            'indentation' => ['left' => $this->m2t(100), 'right' => 0]
        ];

        $section->addText('У Т В Е Р Ж Д А Ю', $cornerStamp, $conerStampPosition);
        $section->addText('Начальник ИЦ МВД по РК', $cornerStamp, $conerStampPosition);
        $section->addText('полковник внутренней службы', $cornerStamp, $conerStampPosition);
        $section->addText('____________ Г.А. Полевкова', $cornerStamp, $conerStampPosition);

        if ($month === 1) {
            $stampMonth = 12;
            $stampYear = $year - 1;
        } else {
            $stampMonth = $month - 1;
            $stampYear = $year;
        }

        $section->addText('" ' . lastDayOfMonth($stampMonth, $stampYear) . ' " ' . getMonth($stampMonth, true) .  ' ' . $stampYear . ' года', $cornerStamp, $conerStampPosition);
        $section->addTextBreak(1);

        $header = ['size' => 14, 'bold' => true, 'align' => 'center'];
        $section->addTextBreak(1);
        $section->addText('Дежурство сотрудников ИЦ на ' . getMonth($month) . ' ' . $year . ' года', $header, ['align' => 'center']);
        $section->addTextBreak(1);

        $fancyTableStyle = ['borderSize' => 6, 'borderColor' => '999999'];
        $cellColSpan = ['gridSpan' => 2];
        $cellHCentered = ['alignment' => JcTable::CENTER];

        $spanTableStyleName = 'new Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);

        $divisionId = null;
        foreach ($employees['employees'] as $key => $employee) {

            $schedules = $employee->schedules;
            if (count($schedules) > 0) {

                if ($employee->division->id <> $divisionId) {
                    if ($key <> 0) {
                        $row = $table->addRow();
                        $row->addCell(10000, $cellColSpan)->addText('');
                    }

                    $row = $table->addRow();
                    $division = is_null($employee->division->level2_full) ? $employee->department->level1_full : $employee->division->level2_full;
                    $row->addCell(10000, $cellColSpan)->addText($division, null, $cellHCentered);
                    $divisionId = $employee->division->id;
                }

                $flag = false;
                foreach ($schedules as $keySchedule => $schedule) {
                    if ($flag === false) {
                        $firstDate = $schedule->date;
                        $lastDate = $schedule->date;
                        $flag = true;
                    }

                    if ($keySchedule > 1 && $this->areDatesConsecutive($schedule->date, $schedules[$keySchedule - 1]->date)) {
                        $lastDate = $schedule->date;
                        $flag = true;
                    }

                    if ($keySchedule > 1 && !$this->areDatesConsecutive($schedule->date, $schedules[$keySchedule - 1]->date)) {
                        $flag = false;
                        //$firstDate = $schedules[$keySchedule - 1]->date;

                        $row = $table->addRow();
                        $row->addCell(3000)->addText(dateDDMMYYYY($firstDate) . ' - ' . dateDDMMYYYY($lastDate), null, $cellHCentered);
                        $cellContent = $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone;
                        $row->addCell(7000)->addText($cellContent);
                    }

                    if ($keySchedule === count($schedules) - 1) {
                        $row = $table->addRow();
                        $row->addCell(3000)->addText(dateDDMMYYYY($firstDate) . ' - ' . dateDDMMYYYY($lastDate), null, $cellHCentered);
                        $cellContent = $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone;
                        $row->addCell(7000)->addText($cellContent);

//                        if (($firstDate <> $year . '-' . $month .'-01') && ($flag === false)) {
//                            $date = new DateTime($firstDate); // Create a DateTime object for today
//                            $date->modify('-1 day'); // Subtract one day
//                            $firstDate =  $date->format('Y-m-d'); // Output: 2025-08-02
//                        }
                    }
                }

//                $row = $table->addRow();
//                $row->addCell(3000)->addText(dateDDMMYYYY($firstDate) . ' - ' . dateDDMMYYYY($lastDate), null, $cellHCentered);
//                $cellContent = $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone;
//                $row->addCell(7000)->addText($cellContent);
            }
        }

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'IC_DUTY_' . date('Y_m_d', strtotime($year . '-' . $month . '-' . '1')) . '.docx';
        $objWriter->save(storage_path('app/' . $fileName));

        // Download the document
        return response()->download(storage_path('app/' . $fileName))->deleteFileAfterSend(true);
    }
}
