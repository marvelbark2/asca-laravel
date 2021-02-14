@if (auth()->user()->lockout_time == '0')
<div class="wrapper">

    @include('layouts.navbars.auth')

    <div class="main-panel">
        @include('layouts.navbars.navs.auth')
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
@else
@include('layouts.navbars.navs.lock')

<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="{{ asset('paper') . '/' . ($backgroundImagePath ?? "img/bg/fabio-mangione.jpg") }}">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>

@endif
