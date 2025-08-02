@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Редактировать Статус служащего</h2>

            @include('inc.message')

            <form method="post" action="{{ route('admin.statuses.update', ['status' => $status]) }}">
                @csrf
                @method('put')
                <div class="form-group mb-4">
                    <label for="letter">Буква</label>
                    <input type="text" class="form-control" name="letter" id="letter" value="{{ $status->letter }}">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description">{!! $status->description !!}</textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="color">HEX код цвета</label>
                    <input type="text" class="form-control" name="color" id="color" value="{{ $status->color }}">
                </div>
                <div class="form-group mb-4">
                    <label for="color_description">Название цвета</label>
                    <input type="text" class="form-control" name="color_description" id="color_description" value="{{ $status->color_description }}">
                </div>
                <br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
