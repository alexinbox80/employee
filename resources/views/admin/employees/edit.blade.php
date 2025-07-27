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
                <div class="form-group">
                    <label for="division_id">Идентификатор подразделения</label>
                    <input type="text" class="form-control" name="division_id" id="division_id" value="{{ $employee->division_id }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $employee->last_name }}">
                </div>
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $employee->first_name }}">
                </div>
                <div class="form-group">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ $employee->middle_name }}">
                </div>
                <div class="form-group">
                    <label for="email">Электронная почта</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ $employee->email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $employee->phone }}">
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <textarea class="form-control" name="address" id="address">{!! $employee->address !!}</textarea>
                </div><br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
