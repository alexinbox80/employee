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
                    <label for="level0_full">Организация, полное наименование</label>
                    <input type="text" class="form-control" name="level0_full" id="level0_full" value="{{ old('level0_full') }}">
                </div>
                <div class="form-group">
                    <label for="level0_short">Организация, краткое наименование</label>
                    <input type="text" class="form-control" name="level0_short" id="level0_short" value="{{ old('level0_short') }}">
                </div>
                <div class="form-group">
                    <label for="level1_full">Подразделение, полное наименование</label>
                    <input type="text" class="form-control" name="level1_full" id="level1_full" value="{{ old('level1_full') }}">
                </div>
                <div class="form-group">
                    <label for="level1_short">Подразделение, краткое наименование</label>
                    <input type="text" class="form-control" name="level1_short" id="level1_short" value="{{ old('level1_short') }}">
                </div>
                <div class="form-group">
                    <label for="level2_full">Отдел, полное наименование</label>
                    <input type="text" class="form-control" name="level2_full" id="level2_full" value="{{ old('level2_full') }}">
                </div>
                <div class="form-group">
                    <label for="level2_short">Отдел, краткое наименование</label>
                    <input type="text" class="form-control" name="level2_short" id="level2_short" value="{{ old('level2_short') }}">
                </div>
                <div class="form-group">
                    <label for="level3_full">Отделение, полное наименование</label>
                    <input type="text" class="form-control" name="level3_full" id="level3_full" value="{{ old('level3_full') }}">
                </div>
                <div class="form-group">
                    <label for="level3_short">Отделение, краткое наименование</label>
                    <input type="text" class="form-control" name="level3_short" id="level3_short" value="{{ old('level3_short') }}">
                </div>
                <div class="form-group">
                    <label for="level4_full">Level 4, полное наименование</label>
                    <input type="text" class="form-control" name="level4_full" id="level4_full" value="{{ old('level4_full') }}">
                </div>
                <div class="form-group">
                    <label for="level4_short">Level 4, краткое наименование</label>
                    <input type="text" class="form-control" name="level4_short" id="level4_short" value="{{ old('level4_short') }}">
                </div>
                <div class="form-group">
                    <label for="level5_full">Level 5, полное наименование</label>
                    <input type="text" class="form-control" name="level5_full" id="level5_full" value="{{ old('level5_full') }}">
                </div>
                <div class="form-group">
                    <label for="level5_short">Level 5, краткое наименование</label>
                    <input type="text" class="form-control" name="level5_short" id="level5_short" value="{{ old('level5_short') }}">
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
