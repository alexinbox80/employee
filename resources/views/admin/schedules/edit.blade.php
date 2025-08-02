@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <div class="dashboard-content">
            <br>
            <h2>Редактировать Планировщик</h2>

            @include('inc.message')

            <form method="post" action="{{ route('admin.schedules.update', ['schedule' => $schedule]) }}">
                @csrf
                @method('put')
                <div class="form-group mb-4">
                    <label for="employee_id">Идентификатор служащего</label>
                    <input type="text" class="form-control" name="employee_id" id="employee_id" value="{{ $schedule->employee_id }}">
                </div>
                <div class="form-group mb-4">
                    <label for="status_id">Идентификатор статуса</label>
                    <input type="text" class="form-control" name="status_id" id="status_id" value="{{ $schedule->status_id }}">
                </div>
                <div class="form-group mb-4">
                    <label for="date">Дата</label>
                    <input type="text" class="form-control" name="date" id="date" value="{{ $schedule->date }}">
                </div>
                <div class="form-group mb-4">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description">{!! $schedule->description !!}</textarea>
                </div>
                <br>
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
