@extends('layouts.admin')
@section('content')
    <div class="dashboard-content">
        <h2>Планировщик</h2>
        <div style="display: flex; justify-content: right;">
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">Добавить Планировщик</a>
        </div><br>
        <div class="alert-message"></div><br>
        <div class="table-responsive">
            @include('inc.message')
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Идентификатор Служащего</th>
                    <th scope="col">Идентификатор Статуса</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Запись создана</th>
                    <th scope="col">Запись обновлена</th>
                    <th scope="col">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @forelse($schedules as $schedule)
                    <tr id="row-{{ $schedule->id }}">
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->employee_id }}</td>
                        <td>{{ $schedule->status_id }}</td>
                        <td>{{ $schedule->date }}</td>
                        <td>{{ $schedule->description }}</td>
                        <td>{{ $schedule->created_at }}</td>
                        <td>{{ $schedule->updated_at }}</td>
                        <td>
                            <div class="link-control">
                                <a
                                    href="{{ route('admin.schedules.edit', ['schedule' => $schedule]) }}">Ред.</a>&nbsp;
                                {{-- <a href="javascript:;" class="delete" rel="{{ $characteristic->id }}" --}}
                                <a href="" style="color: red;">Уд.</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Записей не найдено</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="dashboard-paginated">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
