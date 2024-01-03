<div>
    @livewireStyles
    @include('utils.sessionFlash')
    <div class="min-h-screen sm:block md:flex ">
            <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-400">
                @include("nav.side-nav")        
            </div>
            <div class="overflow-y-auto w-6/7">
                <h1 class="text-xl font-bold">Manage Address</h1>
                <div class="block">
                    <div x-data="{ open: false }" class="pt-5" x-cloak>
                            <button @click="open = true" class="px-4 py-2 text-white rounded-md sm:block md:absolute text-l bg-slate-700 hover:bg-slate-400 right-20" >Add New Location</button>
                        <div x-show="open" @click.outside="open = false">
                            <div class="max-w-sm p-4 border-2 rounded-md border-slate-500">
                                <div class="flex items-center mt-2 form-group">
                                    <label for="unitNo" class="w-32 input-label">Unit No</label>
                                    <input type="text" wire:model="unitNo" class="rounded-md ">
                                </div>
                
                                <div class="flex items-center mt-2 form-group">
                                    <label for="street" class="w-32 input-label">Street</label>
                                    <input type="text" wire:model="street" class="rounded-md ">
                                </div>
                            
                                <div class="flex items-center mt-2 form-group">
                                    <label for="city" class="w-32 input-label">City</label>
                                    <input type="text" wire:model="city" class="rounded-md">
                                </div>
                            
                                
                                <div class="flex items-center form-group">
                                    <label for="state" class="w-32 input-label">State</label>
                                    <div class="relative">
                                        <select wire:model="state" class="mt-2 bg-white border rounded-md input-field ">
                                            <option class="hover:bg-slate-700 focus:bg-slate-800" value="" disabled>Select State</option>
                                            @foreach($malaysiaStates as $malaysiaState)
                                                <option
                                                    class="hover:text-white hover:bg-slate-800 focus:bg-slate-800"
                                                    value="{{ $malaysiaState }}"
                                                >
                                                    {{ $malaysiaState }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="flex items-center mt-2 form-group">
                                    <label for="postCode" class="w-32 input-label">Postcode</label>
                                    <input type="text" wire:model="postCode" class="rounded-md input-field">
                                </div>
                                
                                <div>
                                    <button class="px-3 py-2 text-white rounded-md bg-slate-800 hover:bg-slate-400 text-l" wire:click="addLocation">Add</button>
                                </div>
                                @include('utils.alert-error')
                            </div>
                        </div>     
                    </div>
                    <div class="pt-5 mt-5 mb-5">
                        <div class="grid lg:grid-cols-2 sm:grid-cols-1">
                            @foreach ($locations as $location)
                                <div class="flex-row items-center flex-shrink-0 ">
                                    @livewire('location-form', ['locationID' => $location->locationID], key($location->locationID))
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @livewireScripts
</div>
