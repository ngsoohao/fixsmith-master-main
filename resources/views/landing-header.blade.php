<header class="">
    <div >
        <a href="/"><img src="/img/logo.png"></a>
    </div>
    <div class="">
        @if (Route::has('login'))
        <div class="z-10 p-6 text-lg text-right sm:absolute sm:top-0 sm:right-0 text-slate-700 ">
            <a href="{{route('retrieve-service-type')}}" class="ml-4 text-xl font-semibold hover:text-white ">Services</a>
            
            @if(Auth::check())
                @if(Auth::user()->role === 'user')
                    <a href="{{route('upload-identity-doc')}}" class="ml-4 text-xl font-semibold hover:text-white ">Become a handyman</a>

                @endif
            @endif

            
            @auth
            <a href="{{route('user-dashboard')}}" class="ml-4 text-xl font-semibold hover:text-white">Dashboard</a>

                
            @else
                <a href="{{ route('login') }}" class="ml-4 text-xl font-semibold hover:text-white ">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-xl font-semibold hover:text-white">Register</a>
                @endif
            @endauth
        </div>
        @endif
        
    </div>
</header>
</head>