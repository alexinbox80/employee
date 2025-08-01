@php
    function surname(string $lastName, string $firstName, string $middleName): string
    {
        return ucwords($lastName) . ' ' . strtoupper(substr($firstName, 0, 2)) . '.' . strtoupper(substr($middleName, 0, 2)) . '.';
    }

    function getDay(string $date): string
    {
        return date('d', strtotime($date . '00:00:00'));
    }

    function totalColumn(int $param): string
    {
        return (int)date('t', time()) + $param;
    }

    function dayOfWeek(int $day): string
    {
        $days = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
        return $days[ date('w', strtotime('2025-07-' . $day))];
    }

    function numOfWeek(int $day): int
    {
        return date('w', strtotime('2025-07-' . $day));
    }

    $currentMonth = $month;
    $currentYear = $year;
@endphp
@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="page_header">
            <h1 class="display-5">Дежурства сотрудников</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('page_generate_docx') }}" class="btn btn-primary">Выгрузить в Word</a>
            </div>
            <br>
            <div class="page_header__image p-4 p-md-5 mb-0 w-100"></div>
        </div>
        <x-navigation :$currentMonth :$currentYear/>
        <div class="col-md-6 px-0">
            <table class="table table-striped table-sm">
                <thead>
                <tr class="table_grid">
                    <th scope="col">#</th>
                    <th scope="col">Идентификатор подразделения</th>
                    <th scope="col" class="fio">ФИО</th>
                    @for ($day = 1; $day <= date('t', time()); $day++)
                        <th scope="col"
                            class="{{ ((numOfWeek($day) == 0) || (numOfWeek($day) == 6)) ? 'weekend' : 'work_day' }}">{{ $day }}<br>{{ dayOfWeek($day) }}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @php($divisionId = null)
                @forelse ($employees as $key => $employee)
                    @if ($employee->division->id <> $divisionId)
                        <tr class="table_grid">
                            <td colspan="{{ totalColumn(5) }}" class="department">
                                @if($employee->division->level2_full === null)
                                    <a href="{{ route('page_division', ['division' => $employee->division->id]) }}" class="division_link"
                                       title="{{ $employee->division->level1_full }}">{{ $employee->division->level1_short }}</a>
                                @else
                                    <a href="{{ route('page_division', ['division' => $employee->division->id]) }}" class="division_link"
                                       title="{{ $employee->division->level2_full }}">{{ $employee->division->level2_short }}</a>
                                @endif
                            </td>
                        </tr>
                        @php( $divisionId = $employee->division->id )
                    @endif
                    <tr id="row-{{ $employee->id }}" class="table_grid">
                        <td class="table_id" title="{{ $employee->id }}">{{ $key + 1 }}</td>
                        <td>{{ $employee->department_id }}</td>
                        <td class="fio">
                            <a class="fio_link" href="{{ route('page_employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                                {{ surname($employee->last_name, $employee->first_name, $employee->middle_name) }}
                            </a>
                        </td>
                        @for ($day = 1; $day <= date('t', time()); $day++)
                            <td class="{{ ((numOfWeek($day) == 0) || (numOfWeek($day) == 6)) ? 'weekend' : 'work_day' }}">
                                @foreach ($employee->schedules as $schedule)
                                    @if (getDay($schedule->date) == $day)
                                        <p title="{{ $schedule->status->description }}" style="background-color: {{$schedule->status->color}}"
                                           class="table_grid__p">{{ strtoupper($schedule->status->letter) }}</p>
                                    @endif
                                @endforeach
                            </td>
                        @endfor
                    </tr>
                @empty
                    <tr class="table_grid">
                        <td colspan="{{ totalColumn(5) }}">Записей не найдено</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
