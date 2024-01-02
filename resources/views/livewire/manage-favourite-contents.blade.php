<div>
    @livewireStyles
    @include('utils.sessionFlash')
    <div class="flex min-h-screen ">
        <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-400">
            @include("nav.side-nav")            
        </div>
        <div class="flex-grow overflow-y-auto w-6/7">
            <h1 class="text-xl font-bold">Favourites</h1>
            @php $displayedUsers = []; @endphp
            @foreach ($favListContents as $favListContent)
           
            @php
                $user = $favListContent->serviceProvider->user;
            @endphp
            
            @if (!in_array($user->id, $displayedUsers))
            @php $displayedUsers[] = $user->id; @endphp
            <div class="flex p-5 bg-white rounded-md lg:flex-row">
                
                    <div class="block">
                        <img class="object-cover w-32 h-32 ml-2 rounded-full " src="{{ $favListContent->serviceProvider->user->profile_photo_url }}" width="200" height="200">
                        <div class="mt-11">
                            <a href="{{ route('make-booking', [$favListContent->serviceProviderID]) }}" class="p-2 text-white rounded-md bg-slate-700 hover:bg-slate-400">Select & Continue</a>
                            
                        </div>
                    </div>
                    <div class="flex-grow ml-5">
                        <div x-data="{ open: false }" class="relative flex items-center">
                            <h4 class="text-2xl font-bold">{{ $favListContent->serviceProvider->user->name }}</h4>
                            <p class="ml-2">to help you perform </p>
                            <h5 class="ml-2 text-lg font-bold">{{ $favListContent->serviceProvider->serviceType->serviceTypeName}}</h5>
                            <div class="absolute right-0 flex items-center text-red-500 hover:text-slate-700" wire:click="deleteFavContent({{$favListContent->favouriteListContentID}})">
                                <p> remove from favourites</p>
                                <i class="ml-2 text-2xl fas fa-heart" ></i>
                            </div>
                        
                            
                        </div>
                       
                        <p class="p-2 rounded-md bg-slate-200">Has an average ratings of {{$favListContent->serviceProvider->averageRating}}</p>
                        <p class="p-2 mt-5 mb-1 text-center text-white rounded-md bg-slate-500">How can I help:</p>
                        <p class="p-2 mb-2 text-sm text-center rounded-md bg-slate-200">llo hello hello hello hello hello hello hello</p>
                        <p class="p-2 mt-5 mb-1 text-center text-white rounded-md bg-slate-400">Recent Reviews:</p>
                        <div class="p-2 rounded-md bg-slate-200">
                            @foreach ($favListContent->serviceProvider->reviews->take(3) as $review)
                            <p>{{$review->user->name}} on {{$review->created_at->format('d M Y') }}</p>
                            <p>"{{ $review->reviewText }}"</p>
                            <br>
                        @endforeach
                            
                        
                        </div>
                    </div>
                
            </div>
            <br>
            @endif


            @endforeach
        </div>
    </div>
    <script src="https://kit.fontawesome.com/930fd65046.js" crossorigin="anonymous"></script>

    @livewireScripts
</div>