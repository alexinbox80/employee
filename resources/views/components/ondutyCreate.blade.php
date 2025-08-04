<x-statusPanel :$statuses />
<div class="col-md-10 px-0">
    <a class="fio_link" href="{{ route('page.get.index') }}">НАЗАД</a>
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
                            <a href="{{ route('page.get.division', ['division' => $employee->division->id]) }}" class="division_link"
                               title="{{ $employee->division->level1_full }}">{{ $employee->division->level1_short }}</a>
                        @else
                            <a href="{{ route('page.get.division', ['division' => $employee->division->id]) }}" class="division_link"
                               title="{{ $employee->division->level2_full }}">{{ $employee->division->level2_short }}</a>
                        @endif
                    </td>
                </tr>
                @php( $divisionId = $employee->division->id )
            @endif
            <tr id="employee-{{ $employee->id }}" class="table_grid">
                <td class="table_id" title="{{ $employee->id }}">{{ $key + 1 }}</td>
                <td class="fio">
                    <a class="fio_link" href="{{ route('page.get.employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                        {{ surname($employee->last_name, $employee->first_name, $employee->middle_name) }}
                    </a>
                </td>
                @for ($day = 1; $day <= lastDayOfMonth($month, $year); $day++)
                    <td class="cell_event {{ ((numOfWeek($year, $month, $day) == 0) || (numOfWeek($year, $month, $day) == 6)) ? 'weekend' : 'work_day' }}"
                        data-employee_id="{{ $employee->id }}"
                        data-clicked="0"
                        data-date="{{ $year }}-{{ $month }}-{{ $day }}">
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
                <td colspan="{{ totalColumn(4) }}">Записей не найдено</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="row">
        <div class="d-flex justify-content-between">
            <a class="fio_link" href="{{ route('page.get.index') }}">НАЗАД</a>
            <span id="saveSchedule" class="btn btn-outline-primary me-2">Сохранить</span>
        </div>
    </div>
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

        function createScheduleLists() {
            const lists = [];
            const cellGrids = document.querySelectorAll('.cell_event');
            cellGrids.forEach(cell => {
                if(cell.dataset.clicked > 0) {
                    lists.push({
                        employee_id: cell.dataset.employee_id,
                        status_id: cell.dataset.status_id,
                        date: cell.dataset.date
                    });
                }
            });

            if (lists.length > 0)
                return lists;
            else
                return null;
        }

        async function send(url, data) {
            let response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ data: data })
            })
            .then(res => {
                if (res.ok) { console.log("HTTP request successful") }
                else { console.log("HTTP request unsuccessful") }
                return res
            })
            // .then(res => console.log(res))
            // .then(data => console.log(data))
            // .catch(error => console.log(error)
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            //let result = await response.json();
            //return result;
        }

        document.addEventListener('DOMContentLoaded', function () {
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
                        paragraph.setAttribute('title', selectedValue.description);
                        this.appendChild(paragraph);
                        this.setAttribute('data-status_id', selectedValue.id)

                        // First click: Mark as clicked once
                        cell.dataset.clicked = '1';
                    } else {
                        // Second click: Clear content and reset state
                        cell.textContent = ''; // Or cell.innerHTML = '';
                        cell.dataset.clicked = '0';
                        cell.removeAttribute('data-status_id');
                    }
                });
            });

            const saveDataSpan = document.getElementById('saveSchedule');
            saveDataSpan.addEventListener('click', function() {
                const scheduleLists = createScheduleLists();
                console.log(scheduleLists);

                if (scheduleLists != null)
                    send(`/schedules`, scheduleLists).then((result) => {

                    const answer = JSON.parse(JSON.stringify(result));
                    let alertBlock = document.querySelector('.alert-message');
                    alertBlock.textContent = '';
                    switch (answer.status.toLowerCase()) {
                        case 'ok':
                            console.log(JSON.stringify(result));
                            const message = `Запись с #ID = ${id} успешно удалена`;
                            renderBlock(alertBlock, message, 'success', 'beforeend');
                            let removeRow = document.querySelector('#row-' + id);
                            removeRow.remove();
                            setTimeout("location.reload()", 2000);
                            break;
                        case 'error':
                            console.log(JSON.stringify(result));
                            const error = 'Возникла ошибка при удалении записи';
                            renderBlock(alertBlock, error, 'danger', 'beforeend');
                            break;
                        default:
                            console.log('Wrong Answer');
                    }
                });

            })
        });
    </script>
@endpush
