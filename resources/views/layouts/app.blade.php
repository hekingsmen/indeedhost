<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')

<body>

	

    @include('layouts.nav')

    @if(request()->is('/') || request()->is('home') )

    @include('layouts.slider')

    @endif

        <main id="main">

            @yield('content')

        </main>

    @include('layouts.footer')

</body>

</html>

