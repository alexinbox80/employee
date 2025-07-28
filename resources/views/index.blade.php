@extends('layouts.page')
@section('content')
    <div class="page_header">
        <div class="page_header__image p-4 p-md-5 mb-0 w-100">
            <p class="col-md-6 px-0">
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
                @endphp
                <h1 class="display-5">Дежурство сотрудников</h1>
                <p class="lead my-3">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr class="table_grid">
                                <th scope="col">#</th>
                                <th scope="col">Идентификатор подразделения</th>
                                <th scope="col" class="fio">ФИО</th>
                                @for ($day = 1; $day <= date('t', time()); $day++)
                                    <th scope="col" class="{{ ((numOfWeek($day) == 0) || (numOfWeek($day) == 6)) ? 'weekend' : 'work_day' }}" >{{ $day }} <br> {{ dayOfWeek($day) }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @php($divisionId = null)
                            @forelse ($employees as $employee)
                                @if ($employee->division->id <> $divisionId)
                                    <tr class="table_grid">
                                        <td colspan="{{ totalColumn(5) }}">{{ $employee->division->level0 }}</td>
                                    </tr>
                                    @php( $divisionId = $employee->division->id )
                                @endif
                                <tr id="row-{{ $employee->id }}" class="table_grid">
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->division_id }}</td>
                                    <td class="fio">{{ surname($employee->last_name, $employee->first_name, $employee->middle_name) }}</td>
                                    @for ($day = 1; $day <= date('t', time()); $day++)
                                        <td class="{{ ((numOfWeek($day) == 0) || (numOfWeek($day) == 6)) ? 'weekend' : 'work_day' }}">
                                            @foreach ($employee->schedules as $schedule)
                                                @if (getDay($schedule->date) == $day)
                                                    <p title="{{ $schedule->status->description }}" class="table_grid__p">{{ strtoupper($schedule->status->letter) }}</p>
                                                @else
                                                    &nbsp;
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
                </p>
            </div>
        </div>
    </div>
@endsection
