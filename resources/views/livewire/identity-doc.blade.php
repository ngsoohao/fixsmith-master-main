<div class="h-screen sm:block lg:flex">
    @livewireStyles

    <script src="https://cdn.tailwindcss.com"></script>

    <div class="lg:mr-5 lg:border-r-2 w-1/7 border-slate-500">
        @include("nav.side-nav")        
    </div>
    
    <div class="flex-grow w-6/7">

        @if($existence==false)
            <div class="w-full mx-auto mt-5 text-center bg-zinc-200">
                <div class="">
                    @if (!$showUploadSection)
                        {{-- Add Services Section --}}
                        <h1 class="pt-5 text-2xl font-bold">Tell Us About You</h1><br>
                        <h2 class="font-bold">Please choose the services that you are providing</h2>
                        
                        <input class="w-3/5" wire:model="search" type="text" placeholder="Search service types..." list="serviceTypes">
                        
                        <datalist class="bg-slate-500" id="serviceTypes">
                            @foreach ($serviceTypes as $serviceType)
                                <option value="{{ $serviceType->serviceTypeName }}">
                            @endforeach
                        </datalist>

                        
                        
                        <button class="p-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="addServiceProvider">Add</button>
                        <button class="p-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="next">Next</button>

                        <br>
                        <div>
                            <h2 class="font-bold">Added Services</h2>
                            <p>Please click on the added service to remove it</p>
                            <div>
                                @if ($addedServiceDetails)
                                    @foreach ($addedServiceDetails as $addedServiceDetail)
                                        <button class="relative p-2 mb-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="deleteAddedService({{ $addedServiceDetail->serviceProviderID }})">
                                            {{ $addedServiceDetail->serviceType->serviceTypeName}}
                                            {{-- {{ $addedServiceDetail->serviceProviderID }} --}}
                                        </button>
                                    @endforeach
                                @endif
                            </div>
                            
                            
                        </div>
                    @else
                        {{-- Upload Identity Document Section --}}
                        <form wire:submit.prevent="addNewApplication" enctype="multipart/form-data">
                            <h1 class="pt-5 text-2xl font-bold">Tell Us About You</h1><br>
                            <h2 class="font-bold">Please Upload Your Identity Card For Verification</h2>
                
                            <div>
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                            
                            @if ($fileName)
                                <img src="{{ $fileName->temporaryUrl() }}" alt="preview" class="mt-4" width="300" height="400">
                            @endif
                            
                            <div class="block">
                                <div class="mt-4">
                                    <label for="name">Name:</label><br>
                                    <input type="text" wire:model="name">
                                </div>
                
                                <div class="mt-4">
                                    <label for="documentNumber">Identity Card Number:</label><br>
                                    <input type="text" wire:model="documentNumber">
                                </div>
                
                                <div>
                                    <input class="mt-4" type="file" wire:model="fileName">
                                    @error('fileName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <br><br>
                            <button type="submit" class="px-4 py-2 text-white rounded-md bg-slate-800 hover:bg-slate-400 text-md">Upload</button>
                        </form>
                    @endif
                </div>
                
            </div>
        
        @else

            <div>
                <h1 class="text-2xl font-bold">Document Uploaded</h1>
                <h2 class="text-xl">You application is submitted and pending for processing.</h2>

            </div>
        

        
        @endif
        
        
    </div>
    @livewireScripts
</div>