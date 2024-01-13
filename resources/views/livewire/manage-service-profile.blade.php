<div>
    @include('utils.sessionFlash')
    
    <div class="flex min-h-screen">
        @livewireStyles
        
        <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")        
        </div>
        
        <div class="flex-grow w-6/7">
            <h1 class="text-xl font-bold">Service Profile</h1>
            <div x-data="{open:false}" class="mx-auto" x-cloak>
                
                <button @click="open = true" class="absolute px-4 py-2 text-white rounded-md right-5 bg-slate-600 hover:bg-slate-400">Add Service Profile</button>
                
               
                <div x-show="open" @click.outside="open = false" class="pt-10 ">
                    <div class="mb-2">
                        <label for="serviceType">Service Type</label>
                        <select wire:ignore wire:model.lazy="serviceProviderID" class="w-full p-2 rounded-md">
                        <option>Select Service Type</option>
                        @foreach ($providedServices as $providedService)
                                <option wire:ignore value="{{ $providedService->serviceProviderID }}">{{ $providedService->serviceType->serviceTypeName }}</option>
                        @endforeach
                        </select>
                        @include('utils.alert-error')
                    </div>
                    
                    <div class="mb-2">
                        <label>About Me</label>
                        <textarea class="w-full h-40 rounded-md" wire:ignore wire:model.lazy='aboutMe'></textarea>
                    </div>
                    
                    <div>
                        <label>Skills And Experience</label>
                        <textarea class="w-full h-40 rounded-md" wire:ignore wire:model.lazy="providedServiceDescription"></textarea>
                        
                    </div>
                    
                    <div class="mt-2">
                        <button wire:click='addDescription' class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400">Add</button>
                    </div>
                </div>
                
            </div>

            {{-- list out the added service profile --}}
            <section class="w-full p-2 mt-20 rounded-md ">
                @foreach ($addedServiceProfiles as $addedServiceProfile)
                <div class="px-4 py-2 mb-10 rounded-md bg-slate-200">
                    <h4 class="ml-5 font-bold text-md">Service Profile for {{$addedServiceProfile->serviceProvider->serviceType->serviceTypeName}}</h4>
                    <div class="absolute right-10">
                        <button onclick="toggleForm()" class="px-4 py-2 mt-5 text-white rounded-md bg-slate-600 hover:bg-slate-400 ">Edit</button>
                        <button class="px-4 py-2 mt-5 text-white bg-red-600 rounded-md hover:bg-red-400 right-10" wire:click='deleteDescription({{ $addedServiceProfile->serviceProfileID }})'>Delete</button>
                    </div>
                   
                    <div class="p-4 m-2 rounded-md shadow-xl bg-slate-100">
                        <strong>About Me :</strong><br>
                        <p class="h-20 max-w-5xl my-5 break-all ">{{$addedServiceProfile->aboutMe}}</p>
                        
                    </div>
                    <div class="p-4 m-2 rounded-md shadow-xl bg-slate-100">
                        <strong>How Can I Help :</strong><br>
                        <p class="h-20 max-w-5xl my-5 break-all ">{{$addedServiceProfile->providedServiceDescription}}
</p>
                    </div>
                </div>
                 {{-- hidden form to update service profile --}}
                <div id="inputForm" class="fixed top-0 bottom-0 left-0 right-0 z-50 items-center justify-center hidden bg-gray-800 bg-opacity-75" wire:ignore>
                    <div class="w-3/4 p-8 bg-white rounded-md">
                        <div>
                            <h4 class="mb-5 font-bold text-md">Service Profile for {{$addedServiceProfile->serviceProvider->serviceType->serviceTypeName}}</h4>

                        </div>
                        <div>
                            <label for="title" class="input-label">About Me</label><br>
                            <input type="text" wire:model="aboutMe" class="w-full rounded-md">
                        </div>
                        <div class="mt-4">
                            <label for="description" class="input-label">How Can I Help</label><br>
                            <textarea wire:model='providedServiceDescription' class="w-full h-48 rounded-md"></textarea>
                        </div>
                        <div class="mt-4">
                            <button class="p-2 mt-3 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='editDescription({{$addedServiceProfile->serviceProfileID}})'>Submit</button>
                            <button class="p-2 text-white rounded-md bg-slate-700 hover:bg-gray-400 "onclick="toggleForm()">Cancel</button>
    
                            @include('utils.alert-error')
                        </div>
                        
                    </div>
                </div>
                <script>
                    function toggleForm() {
                        var form = document.getElementById('inputForm');
                        form.classList.toggle('hidden');
                        form.classList.toggle('flex');  
                    }
                </script>
                
                
                @endforeach
            </section>
            
            
            
                
            
            
            
            
        </div>
        @livewireScripts
    </div>
</div>