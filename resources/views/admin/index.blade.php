@extends('layouts.admin')
@section('content')
    {{--<x-admin.iconsMenu/>--}}
    <div class="admin_header">
        <div class="admin_header__image p-4 p-md-5 mb-0 w-100">
            <div class="col-md-6 px-0">
                <h1 class="display-5">Панель управления</h1>
                <p class="lead my-3">Административная панель доступа к данным пользователей и разделам сайта.
                    Добавляйте,
                    редактируйте или удаляйте данные быстро и легко с помощью современного функционала AggFitness.</p>
{{--                <p class="lead mb-0"><a href="{{ route('info.about') }}" class="text-white fw-bold">Подробнее...</a></p>--}}
            </div>
        </div>
    </div>
    <div class="container px-4 py-5" id="icon-grid">
        <h2 class="pb-2 border-bottom border-primary">Инструменты</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
{{--            @foreach (array_slice($menuList, 1) as $key => $item)--}}
{{--                <a href="{{ route($item['route']) }}" class="col d-flex align-items-start text-decoration-none"--}}
{{--                   data-bs-toggle="tooltip" data-bs-title="Подробнее...">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="bi text-muted flex-shrink-0 me-3" width="32"--}}
{{--                         height="32" fill="currentColor">--}}
{{--                        <use xlink:href="#{{ $key }}"/>--}}
{{--                    </svg>--}}
{{--                    <div>--}}
{{--                        <h3 class="fw-bold mb-0 fs-4 text-dark">{{ $item['title'] }}</h3>--}}
{{--                        <p class="text-dark">{{ $item['description'] }}</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            @endforeach--}}
        </div>
        <div class="container px-4 py-4" id="featured-3">
            <h2 class="pb-2 border-bottom border-primary">Наши ценности</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
{{--                @foreach ($valueList as $key => $item)--}}
{{--                    <div class="feature col">--}}
{{--                        <svg class="bi mb-3" width="64" height="64">--}}
{{--                            <use xlink:href="#{{ $key }}"/>--}}
{{--                        </svg>--}}
{{--                        <h3 class="fs-2">{{ $item['title'] }}</h3>--}}
{{--                        <p>{{ $item['description'] }}</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
        </div>
        <h3 class="pb-2 border-bottom border-primary mb-4 pb-3">Список доступных уведомлений</h3>
{{--        @foreach ($messages as $message)--}}
{{--            <x-alert :type="$message" :message="mb_strtoupper($message)" class=""></x-alert>--}}
{{--        @endforeach--}}
    </div>
@endsection
