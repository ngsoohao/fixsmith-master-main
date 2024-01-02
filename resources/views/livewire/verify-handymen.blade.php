<div class="flex h-screen">
    @livewireStyles

    <div class="mr-5 border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")    
    </div>

    <div class="w-6/7">
        <h1 class="text-xl font-bold">Handymen Application</h1>
        <div >
            <div class="grid grid-cols-3 gap-4">
                @if ($imagePath)
                    @foreach ($imagePath as $document)
                        <div class="p-5 border-2 rounded-md border-slate-400">
                            <p>Identity Document ID: {{ $document['identityDocumentID'] }}</p>
                            <p>UserID: {{ $document['id'] }}</p>
                            <p>Name: {{ $document['name'] }}</p>
                            <p>Document Number: {{ $document['documentNumber'] }}</p>
                            <img src="{{ $document['imagePath'] }}" alt="Identity Document" width="300" height="400">
                            <div class="flex flex-row">
                                <button class="p-2 mt-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="approveDocument({{ $document['identityDocumentID'] }})">Approve and Change Role</button>
                                <button class="p-2 mt-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="rejectDocument({{ $document['identityDocumentID'] }})">Reject</button>
                                <button class="p-2 mt-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-300" wire:click="deleteDocument({{ $document['identityDocumentID'] }})">Delete</button>

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

