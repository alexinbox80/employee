@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="page_header mt-5">
            <h1 class="display-5">Создать дежурных</h1>
            <br>
        </div>
        <h2 class="text-center">{{ getMonth($month) }} {{ $year }} года</h2>
        <x-ondutyCreate :$month :$year :$employees :$statuses/>
    </div>
@endsection
