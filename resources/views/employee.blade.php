@extends('layouts.page')
@section('content')
    <div class="page_header">
        <h1 class="display-5">О сотруднике</h1>
        <div class="page_header__image p-4 p-md-5 mb-0 w-100">
            <a class="fio_link" href="{{ route('page_index') }}">НАЗАД</a>
            <ul class="list-group">
                <li class="list-group-item" aria-current="true">
                    <span>Название подразделения:</span>
                    <span>{{ $employee->division->level0_full }}</span>
                </li>
                <li class="list-group-item" aria-current="true">
                    <span>Фамилия:</span>
                    <span>{{ $employee->last_name }}</span>
                </li>
                <li class="list-group-item">
                    <span>Имя:</span>
                    <span>{{ $employee->first_name }}</span>
                </li>
                <li class="list-group-item">
                    <span>Отчество:</span>
                    <span>{{ $employee->middle_name }}</span>
                </li>
                <li class="list-group-item">
                    <span>Должность:</span>
                    <span>{{ $employee->position }}</span>
                </li>
                <li class="list-group-item">
                    <span>Электронная почта:</span>
                    <span>{{ $employee->email }}</span>
                </li>
                <li class="list-group-item">
                    <span>Телефон:</span>
                    <span>{{ $employee->phone }}</span>
                </li>
                <li class="list-group-item">
                    <span>Адрес:</span>
                    <span>{{ $employee->address }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
