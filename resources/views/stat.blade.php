@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="page_header mt-5">
            <h1 class="display-5">Статистика дежурств</h1>
            <br>
        </div>
        <h2 class="text-center"> за {{ $year }} год</h2>

        {{ $month }}
        {{ $year }}
        <br>
        @foreach($schedules as $schedule)
            {{ $schedule->employee_id }}  {{ $schedule->status_id }} {{ $schedule->count }} <br>
            {{ $schedule }} <br>
        @endforeach

{{--        <x-ondutyCreate :$month :$year :$employees :$statuses/>--}}
    </div>
@endsection
