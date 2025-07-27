@extends('layouts.admin')
@section('content')
    <div class="dashboard-content">
        <h2>Подразделения</h2>
        <div style="display: flex; justify-content: right;">
            <a href="{{ route('admin.divisions.create') }}" class="btn btn-primary">Создать Подразделение</a>
        </div><br>
        <div class="alert-message"></div><br>
        <div class="table-responsive">
            @include('inc.message')
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Организация</th>
                    <th scope="col">Подразделение</th>
                    <th scope="col">Отдел</th>
                    <th scope="col">Отделение</th>
                    <th scope="col">level 4</th>
                    <th scope="col">level 5</th>
                    <th scope="col">Должность</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Запись создана</th>
                    <th scope="col">Запись обновлена</th>
                </tr>
                </thead>
                <tbody>
                @forelse($divisions as $division)
                    <tr id="row-{{ $division->id }}">
                        <td>{{ $division->id }}</td>
                        <td>{{ $division->level0 }}</td>
                        <td>{{ $division->level1 }}</td>
                        <td>{{ $division->level2 }}</td>
                        <td>{{ $division->level3 }}</td>
                        <td>{{ $division->level4 }}</td>
                        <td>{{ $division->level5 }}</td>
                        <td>{{ $division->position}}</td>
                        <td>{{ $division->description }}</td>
                        <td>{{ $division->created_at }}</td>
                        <td>{{ $division->updated_at }}</td>
                        <td>
                            <div class="link-control">
                                <a
                                    href="{{ route('admin.divisions.edit', ['division' => $division]) }}">Ред.</a>&nbsp;
                                {{-- <a href="javascript:;" class="delete" rel="{{ $characteristic->id }}" --}}
                                <a href="" style="color: red;">Уд.</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">Записей не найдено</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="dashboard-paginated">
                {{ $divisions->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
