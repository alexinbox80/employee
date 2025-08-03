@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="page_header mt-5">
            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ generateURL(route('page_generate_docx'), $month, $year) }}">Выгрузить в Word</a>
            </div>
            <h1 class="display-5">Дежурство по Информационному центру</h1>
            <br>
        </div>
        <x-navigation :currentMonth="$month"  :currentYear="$year"/>
        <h2 class="text-center">{{ getMonth($month) }} {{ $year }} года</h2>
        <x-onduty :$month :$year :$employees/>
    </div>
@endsection
