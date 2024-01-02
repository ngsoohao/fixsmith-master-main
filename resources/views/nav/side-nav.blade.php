<div class="m-5 rounded-lg outline outline-slate-500" >
    @if(Auth::check())
        @if(Auth::user()->role === 'user')
            @include('nav.nav-user')

        @elseif(Auth::user()->role === 'handymen')
            @include('nav.nav-user')
            @include('nav.nav-handymen')

        @elseif(Auth::user()->role === 'admin')
            @include('nav.nav-admin')

        @endif
    @endif
</div>
