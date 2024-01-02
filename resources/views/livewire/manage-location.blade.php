<div class="flex min-h-screen ">

    <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")        
    </div>
    <div class="flex-grow overflow-y-auto w-6/7">
        <h1 class="text-xl font-bold">Manage Address</h1>
        <div class="">
            <div>
                <button class="absolute px-4 py-2 text-white rounded-md text-l bg-slate-700 hover:bg-slate-400 right-20" wire:click="showForm">Add New Location</button>
            </div>
            <div class="pt-5">
                @if ($showAddForm)
                <div class="max-w-sm p-4 border-2 rounded-md border-slate-500">
                    <div class="flex items-center mt-2 form-group">
                        <label for="unitNo" class="w-32 input-label">Unit No</label>
                        <input type="text" wire:model="unitNo" class="rounded-md input-field">
                    </div>
    
                    <div class="flex items-center mt-2 form-group">
                        <label for="street" class="w-32 input-label">Street</label>
                        <input type="text" wire:model="street" class="rounded-md input-field">
                    </div>
                
                    <div class="flex items-center mt-2 form-group">
                        <label for="city" class="w-32 input-label">City</label>
                        <input type="text" wire:model="city" class="rounded-md input-field">
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
                @endif
                </div>
                
            </div>
    
            <div class="flex flex-row mt-5 mb-5">
                @foreach ($locations as $location)
                    <div class="flex items-center">
                        @livewire('location-form', ['locationid' => $location->locationID], key($location->locationID))
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
