<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }} || @yield('title','Əsas Səhifə')</title>
    <!-- CSS files -->
    <link href="{{  asset('dist') }}/css/tabler.min.css?1692870487" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
</head>

<body>
<div class="page">
    <!-- Sidebar -->
    @include('back.includes.aside')
    <!-- Navbar -->
    @include('back.includes.header')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('back.includes.footer')
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Tabler Core -->
<script src="{{  asset('dist') }}/js/tabler.min.js?1692870487" defer></script>

@yield('js')
</body>

</html>
