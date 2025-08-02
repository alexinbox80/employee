@extends('layouts.page')
@section('content')
    <div class="container">
        <div class="page_header mt-5">
            <div class="d-flex justify-content-end">
                <a href="{{ route('page_generate_docx') }}" class="btn btn-primary">Выгрузить в Word</a>
            </div>
            <h1 class="display-5">Дежурство по Информационному центру</h1>
            <h2>{{ getMonth($month) }} {{ $year }} года</h2>
            <br>
        </div>

        <x-navigation :currentMonth="$month"  :currentYear="$year"/>
        <x-onduty :$month :$year :$employees/>
    </div>
@endsection
