<div class="h-screen sm:block lg:flex">
    @livewireStyles

    <div class="mr-5 border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")    
    </div>

    <div class="flex-grow w-6/7">
        <h1 class="text-xl font-bold">Handymen Application</h1>
        <div>
            <div class="">
                @if ($imagePath)
                    @foreach ($imagePath as $document)
                    
                    <div class="flex p-4 mt-2 rounded-md shadow-lg bg-slate-300">
                        
                            <div class="flex pb-4">
                                <img @click.outside="open=false" src="{{ $document['imagePath'] }}" alt="Identity Document" width="100" height="100" class="bg-white rounded-full">

                                <strong class="ml-5">Identity Document ID: </strong><p class="ml-2">{{ $document['identityDocumentID'] }}</p>
                                <strong class="ml-5">UserID:</strong><p class="ml-2"> {{ $document['id'] }}</p>
                                
                            </div>
                            
                            <div x-data="{open:false}" x-cloak>
                                <button @click="open=true" class="absolute items-center px-4 py-2 text-white rounded-md right-5 bg-slate-700 hover:bg-slate-400">View More</button>
                                <div x-show="open" class="fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-gray-800 bg-opacity-75" >
                                    
                                    <div class="p-4 rounded-md bg-slate-200">
                                        <div>
                                            <strong class="">Name:</strong><p> {{ $document['name'] }}</p>
                                            <strong class="">Document Number:</strong><p> {{ $document['documentNumber'] }}</p>
                                            <strong class="">Provided Services:</strong>
                                            <div class="mb-5">
                                                @foreach ($providedServices as $providedService)
                                                <p>{{ $providedService->serviceType->serviceTypeName }}</p>
                                                @endforeach
                                            </div>
                                            
                                            <img @click.outside="open=false" src="{{ $document['imagePath'] }}" alt="Identity Document" width="400" height="200">
                                            <button class="px-4 py-2 mt-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="approveDocument({{ $document['identityDocumentID'] }})">Approve and Change Role</button>
                                            <button class="px-4 py-2 mt-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="rejectDocument({{ $document['identityDocumentID'] }})">Reject</button>
                                            <button class="px-4 py-2 mt-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-300" wire:click="deleteDocument({{ $document['identityDocumentID'] }})">Delete</button>
                                        </div>
                                        <div>
                                            
                                        </div>
                                            
                                        
                                    </div>
                                </div>
                            </div>
                    </div>
                                                   
                        
                    @endforeach
                @else
                    <p>No pending identity documents found.</p>
                @endif
            </div>
        </div>
    </div>

    @livewireScripts
</div>

{{-- <div class="flex w-3/4 mx-auto">
    <div class="items-center ">
        
    </div>
    <div>

    </div>

</div>
<div class="flex flex-row">
    

</div> --}}