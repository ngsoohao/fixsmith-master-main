<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="/img/favicon.ico">

        <title>Fixsmith</title>
        @livewireStyles

        
        <link href="css/general.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- if session alert exist, return alert message --}}
        @if(session('alert'))
            <script>
                alert("{{ session('alert') }}");
            </script>
        @endif

        

    
    <body>
        <div class="h-screen bg-center bg-cover bg-[url('/img/heropic.jpg')] ">
            @include('landing-header')
            <h1 class="pt-20 ml-20 text-4xl font-bold">Looking for <br> home improvement?</h1><br><br>
            <a class="p-5 mt-20 ml-20 text-3xl font-bold text-white rounded-md bg-slate-800 text-grey hover:text-black hover:bg-slate-200 " 
            href="{{route('retrieve-service-type')}}">Start Booking</a>
        </div>
        
          
        
         
    @livewireScripts
    </body>
   
    
</html>



 