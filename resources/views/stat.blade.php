@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="page_header mt-5">
            <h1 class="display-5">Статистика дежурств</h1>
            <br>
        </div>
        <h2 class="text-center"> за {{ $month }} мес. {{ $year }} год</h2>

        <a class="fio__link" href="{{ route('page.get.index') }}">НАЗАД</a>
        <table id="" class="table table-striped table-sm">
            <thead>
                <tr class="table__stat">
                    <th class="column" scope="col">#</th>
                    <th scope="col" class="fio">ФИО</th>
                    @foreach($statuses as $status)
                        <th scope="col" class="table__stat-th">
                            <p class="table__stat-p" style="background-color: {{ $status->color }}" title="{{ $status->description }}">
                                {{ $status->letter }}
                            </p>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $key => $schedule)
                    <tr id="" class="table__grid">
                        <td class="" title="{{ $schedule['employee']['employee_id'] }}">{{ $loop->iteration }}</td>
                        <td class="fio">
                            <a class="fio__link" href="{{ route('page.get.employee', ['employee' => $schedule['employee']['employee_id']]) }}" title="{{ $schedule['employee']['position'] }}">
                                {{ surname($schedule['employee']['last_name'], $schedule['employee']['first_name'], $schedule['employee']['middle_name']) }}
                            </a>
                        </td>
                        @for ($status = 1; $status <= count($statuses); $status++)
                            @if( isset($schedule['status'][$status]))
                                <td id="" class="">{{ $schedule['status'][$status]['count'] }}</td>
                            @else
                                <td id="" class="">&nbsp;</td>
                            @endif
                        @endfor
                    </tr>
                @empty
                    <tr class="table__grid">
                        <td colspan="{{ count($statuses) + 2 }}">Записей не найдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a class="fio__link" href="{{ route('page.get.index') }}">НАЗАД</a>
    </div>
@endsection
