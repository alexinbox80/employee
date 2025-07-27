@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Добавить Подразделение</h2>

            @include('inc.message')

            <form method="post" action="{{ route('admin.divisions.store') }}">
                @csrf
                <div class="form-group">
                    <label for="level0">Организация</label>
                    <input type="text" class="form-control" name="level0" id="level0" value="{{ old('level0') }}">
                </div>
                <div class="form-group">
                    <label for="level1">Подразделение</label>
                    <input type="text" class="form-control" name="level1" id="level1" value="{{ old('level1') }}">
                </div>
                <div class="form-group">
                    <label for="level2">Отдел</label>
                    <input type="text" class="form-control" name="level2" id="level2" value="{{ old('level2') }}">
                </div>
                <div class="form-group">
                    <label for="level3">Отделение</label>
                    <input type="text" class="form-control" name="level3" id="level3" value="{{ old('level3') }}">
                </div>
                <div class="form-group">
                    <label for="level4">Level 4</label>
                    <input type="text" class="form-control" name="level4" id="level4" value="{{ old('level4') }}">
                </div>
                <div class="form-group">
                    <label for="level5">Level 5</label>
                    <input type="text" class="form-control" name="level5" id="level5" value="{{ old('level5') }}">
                </div>
                <div class="form-group">
                    <label for="position">Должность</label>
                    <input type="text" class="form-control" name="position" id="position" value="{{ old('position') }}">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
                </div>
                <br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
