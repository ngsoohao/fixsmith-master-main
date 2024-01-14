<div class="min-h-screen bg-fixed bg-center" style="background-image: url('/img/heropic.jpg')">
    @livewireStyles
    @include('utils.sessionFlash')
    
    <div class="flex items-center justify-center pt-20 pb-10">
        <input class="w-3/5 rounded-md" wire:model="search" type="text" placeholder="Search service types...">
    </div>
    <div class="flex flex-col lg:flex-row">
        <div class="flex-grow w-full overflow-y-auto lg:w-1/5">
            <div class="mx-auto bg-white rounded-md sm:w-full lg:w-2/3">
                @foreach ($serviceTypes as $serviceType)
                    <div class="flex items-center justify-center p-2 text-md">
                        <a href="{{route('get-handymen-list',['serviceTypeID'=>$serviceType->serviceTypeID])}}" class="block hover:text-slate-400">
                            {{ $serviceType->serviceTypeName }}
                            <br>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 mr-10">
                {{ $serviceTypes->links() }}
            </div>
        </div>
        {{-- handymen list --}}
        <div class="mr-10 lg:w-4/5">
            <h1 class="mb-5 text-3xl font-bold">{{ $serviceTypeName->serviceTypeName }}</h1>
            @foreach ($handymen as $handyman)
                <div class="flex p-5 bg-white rounded-md lg:flex-row">
                    @if ($handyman)
                        <div class="block">
                            <img class="object-cover w-32 h-32 ml-2 rounded-full " src="{{ $handyman->user->profile_photo_url }}" width="200" height="200">
                            
                            <div class="mt-5">
                                <a href="{{ route('make-booking', [$handyman->serviceProviderID]) }}" class="p-2 text-white rounded-md bg-slate-700 hover:bg-slate-400">Select & Continue</a>

                            </div>
                        </div>
                        <div class="flex-grow ml-5">
                            <div x-data="{ open: false }" class="relative flex items-center">
                                <h4 class="text-2xl font-bold">{{ $handyman->user->name }}</h4>
                            
                                <div class="absolute right-0 flex items-center animate__animated animate__bounce hover:text-red-500"  @click="open = !open">
                                    <p class="font-bold"> add to favourites</p>
                                    <i class="ml-2 text-2xl fas fa-heart" ></i>
                                </div>
                            
                                <div x-show="open" @click.away="open = false" class="absolute right-0 p-2 mt-2 bg-white rounded-md shadow-md">
                                    <a href="{{route("manage-favourites")}}"class="p-2 rounded-md hover:bg-slate-700 hover:text-white">Create New Favourite List</a>
                                    @foreach ($favLists as $favList)
                                
                                        <button class="p-2 rounded-md hover:bg-slate-700 hover:text-white"wire:click="addFavourites({{ $favList->favouriteListID }},{{$handyman->serviceProviderID}})">
                                            {{ $favList->favouriteListName }}
                                        </button><br>
                                    @endforeach
                                </div>
                            </div>
                        
                            <p class="p-2 rounded-md bg-slate-200">Has an average ratings of {{$handyman->averageRating}}</p>
                            <p class="w-1/2 p-2 mt-5 mb-1 text-center text-white rounded-md bg-slate-700">How can I help:</p>
                            @if ($serviceProfiles[$handyman->serviceProviderID] !== null)
                                <p class="break-all lg:max-w-4xl">{{ $serviceProfiles[$handyman->serviceProviderID]->aboutMe }}</p>
                            @else
                                <p>This handyman has not added anything yet</p>
                            @endif

                            <p class="w-1/2 p-2 mt-5 mb-1 text-center text-white rounded-md bg-slate-600">Provided Service Description:</p>
                            
                            @if ($serviceProfiles[$handyman->serviceProviderID] !== null) 
                                <p class="break-all sm:max-w-sm lg:max-w-4xl">{{ $serviceProfiles[$handyman->serviceProviderID]->providedServiceDescription }}</p>   
                            @else
                                <p>This handyman has not added anything yet</p>
                            @endif
                           
                            <p class="w-1/2 p-2 mt-5 mb-1 text-center text-white rounded-md bg-slate-500">Recent Reviews:</p>
                            <div class="p-2 rounded-md shadow-md bg-slate-200">
                                
                                    @foreach ($handyman->reviews->take(3) as $review)
                                        <p>{{$review->user->name}} on {{$review->created_at->format('d M Y') }}</p>
                                        <p>"{{ $review->reviewText }}"</p>
                                        <br>
                                    @endforeach

                            </div>

                        </div>
                    @endif
                </div>
                <br>

            @endforeach
        </div>
    </div>
    
    
    @livewireScripts
    <script>
        function toggleForm() {
            var form = document.getElementById('serviceProfileWindow');
            form.classList.toggle('hidden');
            form.classList.toggle('flex');  
        }
    </script>
    <script src="https://kit.fontawesome.com/930fd65046.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
</div>