<x-statusPanel :$statuses />
<div class="col-md-6 px-0">
    <a class="fio_link" href="{{ route('page_index') }}">НАЗАД</a>
    <table id="onduty_create" class="table table-striped table-sm">
        <thead>
        <tr class="table_grid">
            <th scope="col">#</th>
            <th scope="col" class="fio">ФИО</th>
            @for ($day = 1; $day <= lastDayOfMonth($month, $year); $day++)
                <th scope="col"
                    class="{{ ((numOfWeek($year, $month, $day) == 0) || (numOfWeek($year, $month, $day) == 6)) ? 'weekend' : 'work_day' }}">{{ $day }}<br>{{ dayOfWeek($year, $month, $day) }}</th>
            @endfor
        </tr>
        </thead>
        <tbody>
        @php($divisionId = null)
        @forelse ($employees as $key => $employee)
            @if ($employee->division->id <> $divisionId)
                <tr class="table_grid">
                    <td colspan="{{ totalColumn(4) }}" class="department">
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
            <tr id="employee-{{ $employee->id }}" class="table_grid">
                <td class="table_id" title="{{ $employee->id }}">{{ $key + 1 }}</td>
                <td class="fio">
                    <a class="fio_link" href="{{ route('page_employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                        {{ surname($employee->last_name, $employee->first_name, $employee->middle_name) }}
                    </a>
                </td>
                @for ($day = 1; $day <= lastDayOfMonth($month, $year); $day++)
                    <td class="cell_event {{ ((numOfWeek($year, $month, $day) == 0) || (numOfWeek($year, $month, $day) == 6)) ? 'weekend' : 'work_day' }}"
                        data-employee_id="{{ $employee->id }}"
                        data-clicked="0"
                        data-date="{{ $year }}-{{ $month }}-{{ $day }}"></td>
                @endfor
            </tr>
        @empty
            <tr class="table_grid">
                <td colspan="{{ totalColumn(4) }}">Записей не найдено</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <a class="fio_link" href="{{ route('page_index') }}">НАЗАД</a>
</div>

@push('js')
    <script type="text/javascript">
        function getSelectedRadioButtonValue() {
            const radioButtons = document.querySelectorAll('.radioStatusPanel');
            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    return {
                        'id': radioButton.dataset.id,
                        'value': radioButton.value,
                        'color': radioButton.dataset.color,
                        'description': radioButton.dataset.description
                    }
                }
            }
            return null; // No radio button is selected
        }

        document.addEventListener("DOMContentLoaded", function () {
            const tableCells = document.querySelectorAll('#onduty_create .cell_event');

            tableCells.forEach(cell => {
                cell.addEventListener('click', function() {
                    const clickedState = parseInt(cell.dataset.clicked);
                    const selectedValue = getSelectedRadioButtonValue('radioStatusPanel');

                    if (clickedState === 0) {
                        // 1. Создаем новый параграф
                        const paragraph = document.createElement('p');

                        // 2. Добавляем текст в параграф
                        paragraph.style.backgroundColor = selectedValue.color;
                        paragraph.textContent = selectedValue.value;
                        paragraph.classList.add('table_grid__p');
                        paragraph.setAttribute('status_id', selectedValue.id);
                        paragraph.setAttribute('title', selectedValue.description);
                        this.appendChild(paragraph);
                        this.setAttribute('status_id', selectedValue.id)

                        // First click: Mark as clicked once
                        cell.dataset.clicked = '1';
                    } else {
                        // Second click: Clear content and reset state
                        cell.textContent = ''; // Or cell.innerHTML = '';
                        cell.dataset.clicked = '0';
                        cell.removeAttribute('status_id');
                    }
                });
            });
        });
    </script>
@endpush
