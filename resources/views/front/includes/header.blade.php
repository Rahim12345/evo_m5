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
            <a href="{{ route('front.home') }}" class="nav-item nav-link active">@lang('menu.home')</a>
            <a href="{{ route('front.about') }}" class="nav-item nav-link">@lang('menu.about')</a>
            <a href="{{ route('front.courses') }}" class="nav-item nav-link">@lang('menu.courses')</a>
            <a href="{{ route('front.contact') }}" class="nav-item nav-link">@lang('menu.contact')</a>
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
        <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">@lang('menu.join_now')<i
                class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
