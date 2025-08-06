<div class="col-md-12 px-0">
    <table class="table table-striped table-sm">
        <thead>
        <tr class="table__grid">
            <th class="column" scope="col">#</th>
            <th scope="col" class="fio">ФИО</th>
            @for ($day = 1; $day <= lastDayOfMonth($month, $year); $day++)
                <th scope="col"
                    class="column {{ ((numOfWeek($year, $month, $day) == 0) || (numOfWeek($year, $month, $day) == 6)) ? 'weekend' : 'work_day' }}">
                    {{ $day }}<br>{{ dayOfWeek($year, $month, $day) }}
                </th>
            @endfor
        </tr>
        </thead>
        <tbody>
        @php($divisionId = null)
        @forelse ($employees as $key => $employee)
            @if ($employee->division->id <> $divisionId)
                <tr class="table__grid">
                    <td colspan="{{ totalColumn(4) }}" class="department">
                        @if($employee->division->level2_full === null)
                            <a href="{{ route('page.get.division', ['division' => $employee->division->id]) }}" class="division__link"
                               title="{{ $employee->division->level1_full }}">{{ $employee->division->level1_short }}</a>
                        @else
                            <a href="{{ route('page.get.division', ['division' => $employee->division->id]) }}" class="division__link"
                               title="{{ $employee->division->level2_full }}">{{ $employee->division->level2_short }}</a>
                        @endif
                    </td>
                </tr>
                @php( $divisionId = $employee->division->id )
            @endif
            <tr id="row-{{ $employee->id }}" class="table__grid">
                <td class="table_id" title="{{ $employee->id }}">{{ $key + 1 }}</td>
                <td class="fio">
                    <a class="fio__link" href="{{ route('page.get.employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                        {{ surname($employee->last_name, $employee->first_name, $employee->middle_name) }}
                    </a>
                </td>
                @for ($day = 1; $day <= lastDayOfMonth($month, $year); $day++)
                    <td class="{{ ((numOfWeek($year, $month, $day) == 0) || (numOfWeek($year, $month, $day) == 6)) ? 'weekend' : 'work_day' }}">
                        @foreach ($employee->schedules as $schedule)
                            @if (getDay($schedule->date) == $day)
                                <p title="{{ $schedule->status->description }}" style="background-color: {{ $schedule->status->color }}"
                                   class="table__grid-p">{{ strtoupper($schedule->status->letter) }}</p>
                            @endif
                        @endforeach
                    </td>
                @endfor
            </tr>
        @empty
            <tr class="table__grid">
                <td colspan="{{ totalColumn(4) }}">Записей не найдено</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
