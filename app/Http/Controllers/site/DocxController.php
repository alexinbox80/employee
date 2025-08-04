<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Services\Contracts\EmployeeContract;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
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

    private function m2t(int $millimeters): float
    {
        return floor($millimeters * 56.7); //1 твип равен 1/567 сантиметра
    }


    private function getHeadDepartment(Collection $employees, int $id = 1): bool
    {
        foreach ($employees as $employee) {
            if(isset($employee->schedules[0]->date) && $employee->id === $id && date('d', strtotime($employee->schedules[0]->date)) === '01' )
                return true;
        }

        return false;
    }

    private function areDatesConsecutive(string $date1, string $date2): bool
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
        if ($this->getHeadDepartment($employees['employees'], 1) === true) {
            $section->addText('Начальник ИЦ МВД по РК', $cornerStamp, $conerStampPosition);
            $section->addText('полковник внутренней службы', $cornerStamp, $conerStampPosition);
            $section->addText('____________ Г.А. Полевкова', $cornerStamp, $conerStampPosition);
        } else {
            $section->addText('Врио начальника ИЦ МВД по РК', $cornerStamp, $conerStampPosition);
            $section->addText('полковник внутренней службы', $cornerStamp, $conerStampPosition);
            $section->addText('____________ Е.И. Минкин', $cornerStamp, $conerStampPosition);
        }

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

        //$fancyTableStyle = ['borderSize' => 6, 'borderColor' => '999999'];
        $fancyTableStyle = ['borderSize' => 6, 'borderColor' => 'white'];
        $cellColSpan = ['gridSpan' => 2];
        $cellHCentered = ['alignment' => JcTable::CENTER];
        $cellHleft = ['alignment' => JcTable::START];

        $spanTableStyleName = 'new Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);

        $divisionId = null;
        $contents = [];
        foreach ($employees['employees'] as $key => $employee) {

            $schedules = $employee->schedules;
            if (count($schedules) > 0) {

                if ($employee->division->id <> $divisionId) {
                    $division = is_null($employee->division->level2_full) ? $employee->department->level1_full : $employee->division->level2_full;
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

                        $contents[$employee->division->id][] = [
                            'employee_id' => $employee->id,
                            'division_id' => $employee->division->id,
                            'department_id' => $employee->department->id,
                            'division' => $division,
                            'start' => $firstDate,
                            'end' => $lastDate,
                            'text' => $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone
                        ];
                    }

                    if ($keySchedule === count($schedules) - 1) {
//                        if (($firstDate <> $year . '-' . $month .'-01') && ($flag === false)) {
//                            $date = new DateTime($firstDate); // Create a DateTime object for today
//                            $date->modify('-1 day'); // Subtract one day
//                            $firstDate =  $date->format('Y-m-d'); // Output: 2025-08-02
//                        }

                        $contents[$employee->division->id][] = [
                            'employee_id' => $employee->id,
                            'division_id' => $employee->division->id,
                            'department_id' => $employee->department->id,
                            'division' => $division,
                            'start' => $firstDate,
                            'end' => $lastDate,
                            'text' => $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone
                        ];
                    }
                }
           }
        }

        $sortContents = [];
        foreach ($contents as $content) {
            usort($content,  function ($a, $b) {
                $t1 = strtotime($a['start']);
                $t2 = strtotime($b['start']);
                return $t1 - $t2; // For ascending order
                // return $t2 - $t1; // For descending order
            });
            $sortContents[] = $content;
        }

        foreach ($sortContents as $key => $content) {
            $divisionId = null;
            foreach ($content as $item) {
                if ($item['division_id'] <> $divisionId) {
                    $row = $table->addRow();
                    $row->addCell($this->m2t(180), $cellColSpan)->addText('');

                    $row = $table->addRow();
                    $row->addCell($this->m2t(180), $cellColSpan)->addText($key  + 1 . '. ' . $item['division'], ['italic' => true, 'bold' => true], $cellHleft);
                    $divisionId = $item['division_id'];
                }

                $row = $table->addRow();
                $row->addCell($this->m2t(60))->addText(dateDDMMYYYY($item['start']) . ' - ' . dateDDMMYYYY($item['end']), null, $cellHCentered);
                $row->addCell($this->m2t(120))->addText($item['text'], null, $cellHleft);
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
