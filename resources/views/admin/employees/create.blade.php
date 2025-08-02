@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Добавить Служащего</h2>

            @include('inc.message')

            <form method="post" action="{{ route('admin.employees.store') }}">
                @csrf
                <div class="form-group mb-4">
                    <label for="division_id">Идентификатор подразделения</label>
                    <input type="text" class="form-control" name="division_id" id="division_id" value="{{ old('division_id') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="sex">Пол</label>
                    <input type="text" class="form-control" name="sex" id="sex" value="{{ old('sex') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="birth_date">День рождения</label>
                    <input type="text" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="position">Должность</label>
                    <input type="text" class="form-control" name="position" id="position" value="{{ old('position') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="room">Кабинет</label>
                    <input type="text" class="form-control" name="room" id="room" value="{{ old('room') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="email">Электронная почта</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="work_phone">Рабочий телефон</label>
                    <input type="text" class="form-control" name="work_phone" id="work_phone" value="{{ old('work_phone') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="home_phone">Домашний телефон</label>
                    <input type="text" class="form-control" name="home_phone" id="home_phone" value="{{ old('home_phone') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="mobile_phone">Мобильный телефон</label>
                    <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="address">Домашний адрес</label>
                    <textarea class="form-control" name="address" id="address">{!! old('address') !!}</textarea>
                </div>
                <br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
