@if (auth()->user()->lockout_time == '0')
    @if (auth()->user()->type == 'super_admin')
        @include('layouts.navbars.sidebar.admin')
    @elseif (auth()->user()->type == 'user')
        @include('layouts.navbars.sidebar.simple')
    @endif
@else
@endif
