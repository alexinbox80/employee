@extends('layouts.page')
@section('content')
    <div class="page_header">
    </div>
    <div class="container">
        <h1 class="display-5">О подразделении</h1>
        <div class="division_list p-4 p-md-5 mb-0 w-100">
            <a class="division_link" href="{{ route('page.get.index') }}">НАЗАД</a>
            <ul class="list-group">
                <li class="list-group-item" aria-current="true">
                    @if (!empty($division->level2_full))
                        <span>{{ $division->level2_full }}</span>
                    @else
                        <span>{{ $division->level1_full }}</span>
                    @endif
                </li>
                @foreach($employees as $key => $employee)
                    <li class="list-group-item" aria-current="true">
                        <span>{{ $key }}.</span>
                        <span>
                            <a class="division_fio__link" href="{{ route('page.get.employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                                    {{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}
                            </a>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
