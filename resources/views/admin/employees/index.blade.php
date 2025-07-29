@extends('layouts.admin')
@section('content')
    <div class="dashboard-content">
        <h2>Служащие</h2>
        <div style="display: flex; justify-content: right;">
            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Добавить Служащего</a>
        </div><br>
        <div class="alert-message"></div><br>
        <div class="table-responsive">
            @include('inc.message')
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Идентификатор подразделения</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Должность</th>
                    <th scope="col">Эл. почта</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Адрес</th>
                    <th scope="col">Запись создана</th>
                    <th scope="col">Запись обновлена</th>
                </tr>
                </thead>
                <tbody>
                @forelse($employees as $employee)
                    <tr id="row-{{ $employee->id }}">
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->division_id }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->middle_name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <div class="link-control">
                                <a
                                    href="{{ route('admin.employees.edit', ['employee' => $employee]) }}">Ред.</a>&nbsp;
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
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
