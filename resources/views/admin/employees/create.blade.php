@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Добавить Служащего</h2>

            @include('inc.message')

            <form method="post" action="{{ route('admin.employees.store') }}">
                @csrf
                <div class="form-group">
                    <label for="division_id">Идентификатор подразделения</label>
                    <input type="text" class="form-control" name="division_id" id="division_id" value="{{ old('division_id') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
                </div>
                <div class="form-group">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Электронная почта</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <textarea class="form-control" name="address" id="address">{!! old('address') !!}</textarea>
                </div><br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
