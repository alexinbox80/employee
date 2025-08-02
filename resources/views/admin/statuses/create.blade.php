@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Добавить Статус служащего</h2>

            @include('inc.message')

            <form method="post" action="{{ route('admin.statuses.store') }}">
                @csrf
                <div class="form-group mb-4">
                    <label for="letter">Буква</label>
                    <input type="text" class="form-control" name="letter" id="letter" value="{{ old('letter') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="color">HEX код цвета</label>
                    <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}">
                </div>
                <div class="form-group mb-4">
                    <label for="color_description">Название цвета</label>
                    <input type="text" class="form-control" name="color_description" id="color_description" value="{{ old('color_description') }}">
                </div>
                <br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
