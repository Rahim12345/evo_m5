@php use Illuminate\Support\Facades\Route; @endphp
    <!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('front.home') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i> {{ config('app.name') }} </h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('front.home') }}"
               class="nav-item nav-link {{ Route::currentRouteName() == 'front.home' ? 'active' : '' }}">@lang('menu.home')</a>
            <a href="{{ route('front.about') }}"
               class="nav-item nav-link {{ Route::currentRouteName() == 'front.about' ? 'active' : '' }}">@lang('menu.about')</a>
            <a href="{{ route('front.courses') }}"
               class="nav-item nav-link {{ Route::currentRouteName() == 'front.courses' ? 'active' : '' }}">@lang('menu.courses')</a>
            <a href="{{ route('front.contact') }}"
               class="nav-item nav-link {{ Route::currentRouteName() == 'front.contact' ? 'active' : '' }}">@lang('menu.contact')</a>
            <select name="locale" id="locale"
                    onchange="window.location.href='{{ route('locale',['locale'=>':locale']) }}'.replace(':locale',this.value)">
                <option value="{{ app()->getLocale() }}">{{ strtoupper(app()->getLocale()) }}</option>
                @if(app()->getLocale() == 'az')
                    <option value="tr">TR</option>
                    <option value="en">EN</option>
                    <option value="ru">RU</option>
                @elseif(app()->getLocale() == 'tr')
                    <option value="az">AZ</option>
                    <option value="en">EN</option>
                    <option value="ru">RU</option>
                @elseif(app()->getLocale() == 'en')
                    <option value="az">AZ</option>
                    <option value="tr">TR</option>
                    <option value="ru">RU</option>
                @elseif(app()->getLocale() == 'ru')
                    <option value="az">AZ</option>
                    <option value="tr">TR</option>
                    <option value="en">EN</option>
                @endif
            </select>
        </div>
        @if(!auth()->check())
            <a href="{{ route('login') }}"
               class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">@lang('menu.login')<i
                    class="fa fa-arrow-right ms-3"></i></a>
        @else
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                         style="width: 35px; height: 35px;">
                        {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <span class="ms-2">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fa fa-sign-out-alt me-2"></i>@lang('menu.logout')
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>
<!-- Navbar End -->
