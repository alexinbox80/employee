<x-admin.iconsMenu/>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item nav-link">
                <h4>Здравствуйте, {{ 'User' }}!</h4>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.divisions.*')) active @endif" aria-current="page" href="{{ route('admin.divisions.index') }}">
                    <span data-feather="home" class="align-text-bottom">Подразделения</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.employees.*')) active @endif" aria-current="page" href="{{ route('admin.employees.index') }}">
                    <span data-feather="home" class="align-text-bottom">Служащие</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.statuses.*')) active @endif" aria-current="page" href="{{ route('admin.statuses.index') }}">
                    <span data-feather="home" class="align-text-bottom">Статус служащего</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.schedules.*')) active @endif" aria-current="page" href="{{ route('admin.schedules.index') }}">
                    <span data-feather="home" class="align-text-bottom">Планировщик</span>
                </a>
            </li>
            <li class="nav-item">
{{--                @forelse( config('admin.menuList')  as $key => $item)--}}
{{--                    <a class="nav-link @if (request()->routeIs($item['route']))) active @endif" aria-current="page"--}}
{{--                       href="{{ route($item['route']) }}">--}}
{{--                        <span data-feather="home" class="align-text-bottom">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"--}}
{{--                                 class="bi bi-boombox" viewBox="0 0 16 16">--}}
{{--                                <use xlink:href="#{{ $key }}" />--}}
{{--                            </svg>--}}
{{--                            {{ $item['title'] }}--}}
{{--                        </span>--}}
{{--                    </a>--}}
{{--                    @empty--}}
{{--                @endforelse--}}
            </li>
        </ul>
    </div>
</nav>
