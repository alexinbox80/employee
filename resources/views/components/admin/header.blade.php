<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <img class="logo_image_header me-1" src="{{ asset('assets/images/favicon.png') }}" alt="logo"><a
                class="navbar-brand" href="{{ url('/') }}">AggFitness</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
{{--                        <a class="nav-link @if (request()->routeIs('info.home')) active @endif" aria-current="page"--}}
{{--                           href="{{ route('info.home') }}">Главная</a>--}}
                    </li>
                    <li class="dropdown nav-item">
                        <a class="nav-link" href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Меню
                        </a>
                        <ul class="dropdown-menu bg-dark border border-success px-2">
                            <li class="nav-item">
{{--                                <a class="nav-link @if (request()->routeIs('trainers.*')) active @endif"--}}
{{--                                   href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => 0]) }}">Тренеры</a>--}}
                            </li>
                            <li class="nav-item">
{{--                                <a class="nav-link @if (request()->routeIs('gyms.*')) active @endif"--}}
{{--                                   href="{{ route('gyms.index', ['city_id' => 0]) }}">Фитнес-клубы</a>--}}
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="nav-link" href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Инфо
                        </a>
                        <ul class="dropdown-menu bg-dark border border-success px-2">
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link @if (request()->routeIs('info.about')) active @endif"--}}
{{--                                   href="{{ route('info.about') }}">О проекте</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link @if (request()->routeIs('info.contacts')) active @endif"--}}
{{--                                   href="{{ route('info.contacts') }}">Контакты</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link @if (request()->routeIs('info.developers')) active @endif"--}}
{{--                                   href="{{ route('info.developers') }}">Разработчики</a>--}}
{{--                            </li>--}}
                        </ul>
                    </li>

                    @auth
                        @if (Auth::user()->role_id === 1)
                            <li class="nav-item">
{{--                                <a class="nav-link @if (request()->routeIs('admin.*')) active @endif"--}}
{{--                                   href="{{ route('admin.index') }}">Администрировать</a>--}}
                            </li>
                        @else
                            <li class="nav-item">
{{--                                <a class="nav-link @if (request()->routeIs('account')) active @endif"--}}
{{--                                   href="{{ route('account') }}">Личный кабинет</a>--}}
                            </li>
                        @endif
                    @endauth
                    @guest
                        <li class="dropdown nav-item">
                            <a class="nav-link" href="#" role="button" id="dropdownMenuLink"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Аутентификация
                            </a>
                            <ul class="dropdown-menu bg-dark border border-success px-2">
{{--                                @if (Route::has('login'))--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link @if (request()->routeIs('login')) active @endif"--}}
{{--                                           href="{{ route('login') }}">{{ __('Вход') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}

{{--                                @if (Route::has('register'))--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link @if (request()->routeIs('register')) active @endif"--}}
{{--                                           href="{{ route('register') }}">{{ __('Регистрация') }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->name }}--}}
{{--                            </a>--}}

                            <div class="dropdown-menu dropdown-menu-end btn btn-outline-secondary border border-2 border-success bg-dark text-center"
                                 aria-labelledby="navbarDropdown">
{{--                                <a class="dropdown-item text-danger link-dark fw-semibold" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Выход') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
                            </div>
                        </li>
                    @endguest
                </ul>
                @if (request()->routeIs('trainers.index'))
                    <div class="btn-group align-self-start mt-2 me-2 mb-2">
                        <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Город
                        </button>
                        <ul class="dropdown-menu overflow-scroll menu_height">
                            <li id="inputBox" class="ms-2 me-2">
                                <input id="inputCity" type="text" class="form-control form-control-sm"
                                       placeholder="Введите название города" aria-label="Город" name="city">
                            </li>
{{--                            @foreach (config('cities') as $key => $city)--}}
{{--                                @if (Auth::user() && Auth::user()->role_id === 3 && $key === 0)--}}
{{--                                    <li hidden><a class="dropdown-item"--}}
{{--                                                  href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $key]) }}">{{ $city }}</a>--}}
{{--                                    </li>--}}
{{--                                @elseif ($key === 2)--}}
{{--                                    <li class="city"><a class="dropdown-item"--}}
{{--                                                        href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $key]) }}">{{ $city }}</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                @else--}}
{{--                                    <li class="city"><a class="dropdown-item"--}}
{{--                                                        href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $key]) }}">{{ $city }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                        </ul>
                    </div>
                    <form class="d-flex" role="search" method="GET" action="{{ request()->url() }}">
                        <div class="input-group me-2">
                            <input type="text" class="form-control" placeholder="Имя тренера" aria-label="Имя"
                                   name="firstName">
                            <span class="input-group-text"></span>
                            <input type="text" class="form-control" placeholder="Фамилия тренера"
                                   aria-label="Фамилия" name="lastName">
                        </div>
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>
                @elseif (request()->routeIs('gyms.index'))
                    <div class="btn-group align-self-start  mt-2 me-2 mb-2">
                        <button type="button" class="btn btn-outline-success dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Город
                        </button>
                        <ul class="dropdown-menu overflow-scroll menu_height">
                            <li id="inputBox" class="ms-2 me-2">
                                <input id="inputCity" type="text" class="form-control form-control-sm"
                                       placeholder="Введите название города" aria-label="Город" name="city">
                            </li>
{{--                            @foreach (config('cities') as $key => $city)--}}
{{--                                @if (Auth::user() && Auth::user()->role_id === 3 && $key === 0)--}}
{{--                                    <li hidden><a class="dropdown-item"--}}
{{--                                                  href="{{ route('gyms.index', ['city_id' => $key]) }}">{{ $city }}</a>--}}
{{--                                    </li>--}}
{{--                                @elseif ($key === 2)--}}
{{--                                    <li class="city"><a class="dropdown-item"--}}
{{--                                                        href="{{ route('gyms.index', ['city_id' => $key]) }}">{{ $city }}</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                @else--}}
{{--                                    <li class="city"><a class="dropdown-item"--}}
{{--                                                        href="{{ route('gyms.index', ['city_id' => $key]) }}">{{ $city }}</a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                        </ul>
                    </div>
                    <form class="d-flex" role="search" method="GET" action="{{ request()->url() }}">
                        <div class="input-group me-2">
                            <input type="text" class="form-control" placeholder="Название фитнес-клуба"
                                   aria-label="Имя" name="title">
                        </div>
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>
                @else
                    <div class="btn-group align-self-start me-2 mb-2">
                        <a href="{{ request()->url() }}#phone_mask" class="btn btn-outline-success">
                            &#9660 Новости &#9660
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
@include('inc.message')
