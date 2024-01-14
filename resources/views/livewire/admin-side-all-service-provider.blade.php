<div class="h-screen sm:block lg:flex">
    @livewireStyles

    <div class="flex-shrink-0 mr-5 lg:border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")    
    </div>

    <div class="flex-grow w-6/7">
        <h1 class="mb-4 text-2xl font-bold">All Service Providers</h1>
        <div>
            <input class="w-4/5 mx-auto mb-5 rounded-md"wire:model="search" type="text" placeholder="Search Service Providers Via User ID or Service Provider ID" />
        
            <table class="items-center text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Service Provider ID</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">User ID</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">User</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Service Type</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Average Rating</th>
                        

                    </tr>
                </thead>
                @foreach($allServiceProviders as $serviceProvider)
                    <tr>
                        
                        <td class="px-4 py-2 border border-gray-400">{{ $serviceProvider->serviceProviderID }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $serviceProvider->id }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $serviceProvider->user->name}}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $serviceProvider->serviceType->serviceTypeName}}</td>
                        <td class="px-4 py-2 border border-gray-400">
                            @if ($serviceProvider->averageRating) 
                                {{ $serviceProvider->averageRating }}
                                
                            @else 
                                <p>No Ratings Yet</p>
                            @endif                        
                        </td>
                        
                        {{-- <td class="p-2 border border-gray-400">
                            <div x-data="{ open: false }" x-cloak>
                                <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" @click="open = !open">Expand</button>
                            
                                <div x-show="open">
                                    <p>Hi</p>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </table>
        
            {{ $allServiceProviders->links() }}
        </div>

    </div>

</div>