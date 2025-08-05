@extends('layouts.page')
@section('content')
    <div class="page_header">
    </div>
    <div class="container">
        <h1 class="display-5">О сотруднике</h1>
        <div class="d-flex">
            <div class="employee_list w-50">
                <a class="division_link" href="{{ route('page.get.index') }}">НАЗАД</a>
                <ul class="list-group">
                    <li class="list-group-item" aria-current="true">
                        <span>Орган:</span>
                        <span>{{ $employee->division->level0_full }}</span>
                    </li>
                    <li class="list-group-item" aria-current="true">
                        <span>Подразделение:</span>
                        <span>{{ $employee->division->level1_full }}</span>
                    </li>
                    @if (!empty($employee->department->level2_full))
                        <li class="list-group-item" aria-current="true">
                            <span>Отдел:</span>
                            <span>{{ $employee->department->level2_full }}</span>
                        </li>
                    @endif
                    @if (!empty($employee->division->level3_full))
                        <li class="list-group-item" aria-current="true">
                            <span>Отделение:</span>
                            <span>{{ $employee->division->level3_full }}</span>
                        </li>
                    @endif
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
                    @if (!empty($employee->room))
                        <li class="list-group-item">
                            <span>Номер кабинета:</span>
                            <span>{{ $employee->room }}</span>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <span>Электронная почта:</span>
                        <span>{{ $employee->email }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Телефон рабочий:</span>
                        <span>{{ $employee->work_phone }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>День рождения:</span>
                        <span>{{ dateDDMMYYYY($employee->birth_date) }}</span>
                    </li>
                    @if (!empty($employee->home_phone))
                        <li class="list-group-item">
                            <span>Телефон домашний:</span>
                            <span>{{ $employee->home_phone }}</span>
                        </li>
                    @endif
                    <li class="list-group-item">
                        <span>Телефон мобильный:</span>
                        <span>{{ $employee->mobile_phone }}</span>
                    </li>
                    <li class="list-group-item">
                        <span>Домашний адрес:</span>
                        <span>{{ $employee->address }}</span>
                    </li>
                </ul>
            </div>
            <div class="employee__picture w-50">
                @if($employee->sex === 'МУЖСКОЙ')
                    <img class="employee__img" src="{{ asset('storage/picture/men.png') }}" alt="employee">
                @else
                    <img class="employee__img" src="{{ asset('storage/picture/woman.png') }}" alt="employee">
                @endif
            </div>
        </div>
    </div>
@endsection
