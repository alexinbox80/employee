@extends('layouts.page')
@section('content')
    <div class="page__header">
    </div>
    <div class="container">
        <h1 class="display-5">О подразделении</h1>
        <div class="division__list p-4 p-md-5 mb-0 w-100">
            <a class="division__link" href="{{ route('page.get.index') }}">НАЗАД</a>
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
                        <span>{{ $key + 1 }}.</span>
                        <span>
                            <a class="division__fio-link" href="{{ route('page.get.employee', ['employee' => $employee->id]) }}" title="{{ $employee->position }}">
                                    {{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}
                            </a>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
