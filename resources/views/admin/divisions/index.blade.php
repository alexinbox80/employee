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
                    <th scope="col">Организация, полное наименование</th>
                    <th scope="col">Организация, краткое наименование</th>
                    <th scope="col">Подразделение, полное наименование</th>
                    <th scope="col">Подразделение, краткое наименование</th>
                    <th scope="col">Отдел, полное наименование</th>
                    <th scope="col">Отдел, краткое наименование</th>
                    <th scope="col">Отделение, полное наименование</th>
                    <th scope="col">Отделение, краткое наименование</th>
                    <th scope="col">level 4, полное наименование</th>
                    <th scope="col">level 4, краткое наименование</th>
                    <th scope="col">level 5, полное наименование</th>
                    <th scope="col">level 5, краткое наименование</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Запись создана</th>
                    <th scope="col">Запись обновлена</th>
                </tr>
                </thead>
                <tbody>
                @forelse($divisions as $division)
                    <tr id="row-{{ $division->id }}">
                        <td>{{ $division->id }}</td>
                        <td>{{ $division->level0_full }}</td>
                        <td>{{ $division->level0_short }}</td>
                        <td>{{ $division->level1_full }}</td>
                        <td>{{ $division->level1_short }}</td>
                        <td>{{ $division->level2_full }}</td>
                        <td>{{ $division->level2_short }}</td>
                        <td>{{ $division->level3_full }}</td>
                        <td>{{ $division->level3_short }}</td>
                        <td>{{ $division->level4_full }}</td>
                        <td>{{ $division->level4_short }}</td>
                        <td>{{ $division->level5_full }}</td>
                        <td>{{ $division->level5_short }}</td>
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
                        <td colspan="16">Записей не найдено</td>
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
