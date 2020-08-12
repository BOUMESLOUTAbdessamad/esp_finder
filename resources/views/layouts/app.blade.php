<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.headers.head')
<body>
    <div id="app">
        @include('layouts.headers.nav')
        <main class="py-4" style="min-height: 500px;">
            @yield('content')
        </main>
    </div>
    @include('layouts.footers.footer')

</body>
</html>
