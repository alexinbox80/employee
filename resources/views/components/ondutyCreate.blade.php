<x-statusPanel :$statuses />
<div class="col-md-12 px-0">
    <a class="fio__link" href="{{ route('page.get.index') }}">НАЗАД</a>
    <div class="alert-message"></div>
    <table id="onduty__create" class="table-fixed table table-striped table-sm">
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
                <tr id="employee-{{ $employee->id }}" class="table__grid">
                    <td class="table_id" title="{{ $employee->id }}">{{ $key + 1 }}</td>
                    <td class="fio">
                        <a class="fio__link" href="{{ route('page.get.employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                            {{ surname($employee->last_name, $employee->first_name, $employee->middle_name) }}
                        </a>
                    </td>
                    @for ($day = 1; $day <= lastDayOfMonth($month, $year); $day++)
                        <td id="cell-{{ $employee->id * 100 + $day }}"
                            class="cell__event {{ ((numOfWeek($year, $month, $day) == 0) || (numOfWeek($year, $month, $day) == 6)) ? 'weekend' : 'work_day' }}"
                            data-date="{{ $year }}-{{ $month }}-{{ $day }}"></td>
                    @endfor
                </tr>
            @empty
                <tr class="table__grid">
                    <td colspan="{{ totalColumn(4) }}">Записей не найдено</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="row">
        <div class="d-flex justify-content-between">
            <a class="fio__link" href="{{ route('page.get.index') }}">НАЗАД</a>
            <div class="d-flex">
                <span id="clear__schedule-bottom" class="btn btn-outline-info me-2">Очистить</span>
                <span id="save__schedule" class="btn btn-outline-primary me-2">Сохранить</span>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script type="module" defer src="{{ asset('assets/js/schedule/main.js') }}" ></script>
@endpush
