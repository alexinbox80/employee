<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Services\Contracts\EmployeeContract;
use Carbon\Carbon;
use DateTime;
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

    public function generate(): BinaryFileResponse
    {
        $employees = $this->employeeService->index();

        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(10);

        $sectionStyle = [
            'orientation' => 'portrait',
            'marginLeft' => $this->m2t(15), //Левое поле равно 15 мм
            'marginRight' => $this->m2t(15),
            'marginTop' => $this->m2t(15),
            'borderTopColor' => 'C0C0C0'
        ];
        $section = $phpWord->addSection($sectionStyle);

        //$section = $phpWord->addSection();

        // Add text
        $section->addText('Hello, this is a generated DOCX document from Laravel!',  null, ['align' => JcTable::START]);
        $section->addText('This text is bold and italic.', ['bold' => true, 'italic' => true]);


        $header = ['size' => 16, 'bold' => true, 'align' => 'center'];
        $section->addText('Table with colspan and rowspan', null, $header);



        /*
 *  3. colspan (gridSpan) and rowspan (vMerge)
 *  -------------------------
 *  |  A  |     B     |  C  |
 *  |-----|-----------|     |
 *  |        D        |     |
 *  ------|-----------|     |
 *  |  E  |  F  |  G  |     |
 *  -------------------------
 */

        //$section->addPageBreak();
        $section->addTextBreak(1);
        $section->addText('Table with colspan and rowspan', $header, ['align' => 'center']);
        $section->addTextBreak(1);

        $fancyTableStyle = ['borderSize' => 6, 'borderColor' => '999999'];
        $cellRowSpan = ['vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFF00'];
        $cellRowContinue = ['vMerge' => 'continue'];
        $cellColSpan = ['gridSpan' => 2];
        $cellHCentered = ['alignment' => JcTable::CENTER];
        $cellVCentered = ['valign' => 'center'];




        $spanTableStyleName = 'new Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);

        $divisionId = null;
        foreach ($employees['employees'] as $key => $employee) {

            $schedules = $employee->schedules;
            if (count($schedules) > 0) {
//                $firstItem = array_shift($schedules);
//                $lastItem = end($schedules);

                $flag = false;
                foreach ($schedules as $keySchedules => $schedule) {
//                    dump($schedule->date);
//                    dump($schedule->status->letter);

                    if ($flag === false) {
                        $firstDate = $schedule->date;
                        $flag = true;
                    }

                    if ($keySchedules > 1 && $this->areDatesConsecutive($schedule->date, $schedules[$keySchedules - 1]->date)) {
                        //dump('if() ' . $this->areDatesConsecutive($schedule->date, $schedules[$keySchedules - 1]->date));
                        //$firstDate = $schedule->date;
                        $lastDate = $schedules[$keySchedules]->date;
                        $flag = true;
                    }

                    if ($keySchedules > 1 && !$this->areDatesConsecutive($schedule->date, $schedules[$keySchedules - 1]->date)) {
                        $flag = false;
                    }
                }

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

                $row = $table->addRow();
//                dump('-> ' . $employee->last_name);
//                dump('-> ' . dateDDMMYYYY($firstDate));
//                dump('-> ' . dateDDMMYYYY($lastDate));
                //dateDDMMYYYY($firstItem['date']) . '-' . dateDDMMYYYY($lastItem['date'])
                $row->addCell(3000)->addText(dateDDMMYYYY($firstDate) . ' - ' . dateDDMMYYYY($lastDate), null, $cellHCentered);
                $cellContent = $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone;
                $row->addCell(7000)->addText($cellContent);
            }
        }

        // Save the document
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $fileName = 'IC_DUTY_' . Carbon::now('Europe/Moscow')->toDateString() . '.docx';
        $objWriter->save(storage_path('app/' . $fileName));

        // Download the document
        return response()->download(storage_path('app/' . $fileName))->deleteFileAfterSend(true);
    }
}
