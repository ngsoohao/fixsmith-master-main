<!DOCTYPE html>
<html lang="en">
<head>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

    
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="css/general.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    @include('navigation-menu')
    @if(Auth::check())
        @if(Auth::user()->role === 'admin')
        <title>Admin Dashboard</title>
        @elseif(Auth::user()->role === 'handymen')
        <title>Handymen Dashboard</title>
        @elseif(Auth::user()->role === 'user')
        <title>User Dashboard</title>
        @endif
    @endif
</head>

<body>
    <div class="flex h-screen">
    
        <div class="mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")
    
        </div>
        <div class="w-6/7">
            
        </div>
    </div>
    

    
</body>
@livewireScripts
</html>

