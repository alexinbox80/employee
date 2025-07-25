@extends('layouts.admin')
@section('content')
    <div class="dashboard-content">
        <h2>Статус служащего</h2>
        <div style="display: flex; justify-content: right;">
            <a href="{{ route('admin.statuses.create') }}" class="btn btn-primary">Добавить Статус служащего</a>
        </div><br>
        <div class="alert-message"></div><br>
        <div class="table-responsive">
            @include('inc.message')
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Сокращение</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Запись создана</th>
                    <th scope="col">Запись обновлена</th>
                </tr>
                </thead>
                <tbody>
                @forelse($statuses as $status)
                    <tr id="row-{{ $status->id }}">
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->letter }}</td>
                        <td>{{ $status->description }}</td>
                        <td>{{ $status->created_at }}</td>
                        <td>{{ $status->updated_at }}</td>
                        <td>
                            <div class="link-control">
                                <a
                                    href="{{ route('admin.statuses.edit', ['status' => $status]) }}">Ред.</a>&nbsp;
                                {{-- <a href="javascript:;" class="delete" rel="{{ $characteristic->id }}" --}}
                                <a href="" style="color: red;">Уд.</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13">Записей не найдено</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="dashboard-paginated">
                {{ $statuses->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
