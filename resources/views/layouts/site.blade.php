<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="author" content="Bleu">
    <meta name="description" content="{{ setting('site.description') }}">
    <title>{{ setting('site.title') }}</title>
    <link href="{{ asset('assets/img/icon/favicon-96x96.png') }}" rel="icon" sizes="96x96" type="image/png">
    <link href="{{ asset('assets/img/icon/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png">
    <link href="{{ asset('assets/img/icon/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png">
    <script src="{{ asset('assets/vendor/leaflet/leaflet.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ mix('css/app.css') }}" media="print" onload='this.media="all"' rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @livewireStyles

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    @include('partials.header')
    <main id="main">
        @yield('content')
    </main>
    @include('partials.footer')
    @stack('modals')
    <nav class="mobile-nav">
        <ul>
            {{ menu('main', 'partials.menus.main') }}
            <a href="{{ route('cart.index') }}" data-turbolinks-action="replace"
                class="block mt-4 lg:inline-block lg:mt-0 mr-4">購物車({{ Cart::count() }})</a>
            @if (Route::has('login'))
                @auth
                    <li class="font-semibold"><a href="{{ route('dashboard') }}">{{ __('我的帳戶') }}</a></li>
                @else
                    <li class="font-semibold"><a href="{{ route('login') }}">{{ __('登入') }}</a></li>

                    @if (Route::has('register'))
                        <li class="font-semibold"><a href="{{ route('register') }}">{{ __('註冊') }}</a></li>
                    @endif
                @endauth
            @endif
        </ul>
    </nav><!-- .nav-menu -->
    <div class="mobile-nav-overly none"></div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @livewireScripts
</body>

</html>
