@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Редактировать Служащего</h2>
            @include('inc.message')

            <form method="post" action="{{ route('admin.employees.update', ['employee' => $employee]) }}">
                @csrf
                @method('put')
                <div class="form-group mb-4">
                    <label for="division_id">Идентификатор подразделения</label>
                    <input type="text" class="form-control" title="{{ $employee->division->level1_full }}" name="division_id" id="division_id" value="{{ $employee->division_id }}">
                </div>
                <div class="form-group mb-4">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $employee->last_name }}">
                </div>
                <div class="form-group mb-4">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $employee->first_name }}">
                </div>
                <div class="form-group mb-4">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ $employee->middle_name }}">
                </div>
                <div class="form-group mb-4">
                    <label for="sex">Пол</label>
                    <input type="text" class="form-control" name="sex" id="sex" value="{{ $employee->sex }}">
                </div>
                <div class="form-group mb-4">
                    <label for="birth_date">День рождения</label>
                    <input type="text" class="form-control" name="birth_date" id="birth_date" value="{{ dateDDMMYYYY($employee->birth_date) }}">
                </div>
                <div class="form-group mb-4">
                    <label for="position">Должность</label>
                    <input type="text" class="form-control" name="position" id="position" value="{{ $employee->position }}">
                </div>
                <div class="form-group mb-4">
                    <label for="room">Кабинет</label>
                    <input type="text" class="form-control" name="room" id="room" value="{{ $employee->room }}">
                </div>
                <div class="form-group mb-4">
                    <label for="email">Электронная почта</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $employee->email }}">
                </div>
                <div class="form-group mb-4">
                    <label for="work_phone">Рабочий телефон</label>
                    <input type="text" class="form-control" name="work_phone" id="work_phone" value="{{ $employee->work_phone }}">
                </div>
                <div class="form-group mb-4">
                    <label for="home_phone">Домашний телефон</label>
                    <input type="text" class="form-control" name="home_phone" id="home_phone" value="{{ $employee->home_phone }}">
                </div>
                <div class="form-group mb-4">
                    <label for="mobile_phone">Мобильный телефон</label>
                    <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="{{ $employee->mobile_phone }}">
                </div>
                <div class="form-group mb-4">
                    <label for="address">Домашний адрес</label>
                    <textarea class="form-control" name="address" id="address">{!! $employee->address !!}</textarea>
                </div><br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
