<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Services\Contracts\EmployeeContract;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\JcTable;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class DocxController extends Controller
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

    private function areDatesConsecutive(string $date1, string $date2, int $employeeId1, int $employeeId2, int $statusId1, int $statusId2): bool
    {
        $firstDate = new DateTime($date1);
        $secondDate = new DateTime($date2);

        $diff = $firstDate->diff($secondDate);
        return abs($diff->days) === 1 && $employeeId1 === $employeeId2;// && $statusId1 === $statusId2;
    }

    private function sortArrayElements(array $elements, string $fieldName = 'start'): array
    {
        $sortContents = [];
        foreach ($elements as $vol => $content) {
            usort($content,  function ($a, $b) use ($fieldName){
                $t1 = strtotime($a[$fieldName]);
                $t2 = strtotime($b[$fieldName]);
                return $t1 - $t2; // For ascending order
                // return $t2 - $t1; // For descending order
            });
            $sortContents[$vol] = $content;
        }

        return $sortContents;
    }

    private function dayToWeekArray(array $object): array
    {
        $items = [];
        $firstDate = null;
        foreach ($object as $contents) {
            $flag = false;
            foreach ($contents as $key => $content) {
                if ($flag === false) {
                    $firstDate = $content['date'];
                    $flag = true;
                }

                if ($key < count($contents) - 1 &&
                    $this->areDatesConsecutive(
                        $content['date'],
                        $contents[$key + 1]['date'],
                        $content['employee_id'],
                        $contents[$key + 1]['employee_id'],
                        $content['status_id'],
                        $contents[$key + 1]['status_id']
                    )) {
                    $flag = true;
                }

                if ($key < count($contents) - 1 &&
                    !$this->areDatesConsecutive(
                        $content['date'],
                        $contents[$key + 1]['date'],
                        $content['employee_id'],
                        $contents[$key + 1]['employee_id'],
                        $content['status_id'],
                        $contents[$key + 1]['status_id']
                    )) {
                    $flag = false;

                    $items[$content['division_id']][] = [
                        'employee_id' => $content['employee_id'],
                        'division_id' => $content['division_id'],
                        'department_id' => $content['department_id'],
                        'status_id' => $content['status_id'],
                        'division' => $content['division'],
                        'start' => $firstDate,
                        'end' => $content['date'],
                        'text' => $content['text'],
                    ];
                }

                if ($key === count($contents) - 1)
                    $items[$content['division_id']][] = [
                        'employee_id' => $content['employee_id'],
                        'division_id' => $content['division_id'],
                        'department_id' => $content['department_id'],
                        'status_id' => $content['status_id'],
                        'division' => $content['division'],
                        'start' => $firstDate,
                        'end' => $content['date'],
                        'text' => $content['text'],
                    ];
            }
        }

        return $items;
    }

    private function getEmployeeArray(object $employee, object $schedule, string $division): array
    {
        return [
            'employee_id' => $employee->id,
            'division_id' => $employee->division->id,
            'department_id' => $employee->department->id,
            'status_id' => $schedule->status_id,
            'division' => $division,
            'date' => $schedule->date,
            'text' => $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name . ', м.т.: ' . $employee->mobile_phone
        ];
    }

    private function object2array(array $object): array
    {
        $divisionId = null;
        $content1 = [];
        $content2 = [];
        $content3 = [];
        $division = null;
        foreach ($object['employees'] as $employee) {
            $schedules = $employee->schedules;
            if (count($schedules) > 0) {
                $scheduleId = [5, 10, 12];
                foreach ($schedules as $schedule) {
                    if (in_array($schedule->status_id, $scheduleId)) {

                        if ($employee->division->id <> $divisionId) {
                            $division = is_null($employee->division->level2_full) ? $employee->department->level1_full : $employee->division->level2_full;
                            $divisionId = $employee->division->id;
                        }

                        if ($schedule->status_id === 10) {
                            $content1[$schedule->status_id][$employee->division->id][] = $this->getEmployeeArray($employee, $schedule, $division);
                        }

                        if ($schedule->status_id === 12) {
                            $content2[$schedule->status_id][$employee->division->id][] = $this->getEmployeeArray($employee, $schedule, $division);
                        }

                        if ($schedule->status_id === 5) {
                            $content3[$schedule->status_id][$employee->division->id][] = $this->getEmployeeArray($employee, $schedule, $division);
                        }
                    }
                }
            }
        }

        return [
            10 => isset($content1[10]) ? $this->sortArrayElements([10 => array_merge(...$this->dayToWeekArray($content1[10]))]) : null,
            12 => isset($content2[12]) ? $this->sortArrayElements($this->dayToWeekArray($content2[12])) : null,
            5 => isset($content3[5]) ? $this->sortArrayElements($this->dayToWeekArray($content3[5])) : null,
        ];
    }

    /**
     * @throws Exception
     */
    public function generate(Request $request): BinaryFileResponse
    {
        $month = (int) $request->query('month');
        $year = (int) $request->query('year');

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
        if ($this->getHeadDepartment($employees['employees']) === true) {
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
        $section->addTextBreak();

        $header = ['size' => 14, 'bold' => true, 'align' => 'center'];
        $section->addTextBreak();
        $section->addText('Дежурство сотрудников ИЦ на ' . getMonth($month) . ' ' . $year . ' года', $header, ['align' => 'center']);
        $section->addTextBreak();

        //$fancyTableStyle = ['borderSize' => 6, 'borderColor' => '999999'];
        $fancyTableStyle = ['borderSize' => 6, 'borderColor' => 'white'];
        $cellColSpan = ['gridSpan' => 2];
        $cellHCentered = ['alignment' => JcTable::CENTER];
        $cellHleft = ['alignment' => JcTable::START];

        $spanTableStyleName = 'new Colspan Rowspan';
        $phpWord->addTableStyle($spanTableStyleName, $fancyTableStyle);
        $table = $section->addTable($spanTableStyleName);

        $sortContents = $this->object2array($employees);

        $key = 1;
        foreach ($sortContents as $value => $sorts) {
            if ($value === 10) {
                $row = $table->addRow();
                $row->addCell($this->m2t(180), $cellColSpan)->addText($key . '. ' . 'Информационный центр', ['italic' => true, 'bold' => true], $cellHleft);
            }
            if (isset($sorts))
                foreach ($sorts as $content) {
                $divisionId = null;
                foreach ($content as $item) {
                    if ($item['division_id'] <> $divisionId && $value !== 10) {
                        $row = $table->addRow();
                        $row->addCell($this->m2t(180), $cellColSpan)->addText('');

                        $row = $table->addRow();
                        $row->addCell($this->m2t(180), $cellColSpan)->addText($key + 1 . '. ' . $item['division'], ['italic' => true, 'bold' => true], $cellHleft);
                        $divisionId = $item['division_id'];

                        $key++;
                    }

                    $row = $table->addRow();
                    $row->addCell($this->m2t(60))->addText(dateDDMMYYYY($item['start']) . ' - ' . dateDDMMYYYY($item['end']), null, $cellHCentered);
                    $row->addCell($this->m2t(120))->addText($item['text'], null, $cellHleft);
                }
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
