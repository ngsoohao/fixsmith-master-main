<div class="flex h-screen">
    <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-400">
        @include('nav.side-nav')

    </div>
    <div class='flex-grow overflow-y-auto w-6/7'>
        <h1 class="text-xl font-bold">Manage Service Type</h1>

        <div class="">
            <div>
                <button onclick="toggleForm()" wire:ignore class="absolute p-2 text-white rounded-md right-20 bg-slate-700 hover:bg-slate-400">Add Service Type</button>
            </div>
            <br><br>
            <div>
                @if ($serviceType)
                    @foreach ($serviceType as $serviceTypes)
                        <div class="relative flex items-center p-3 mr-3 bg-slate-400 ">
                            <div class="w-full p-2 pt-2 pb-2 mt-2 mr-2 border-2 rounded-md bg-slate-300">
                                <div class="flex items-center">
                                    
                                    @if ($editMode && $selectedServiceTypeId === $serviceTypes->serviceTypeID)
                                        <input class="" type="text" wire:model="editedServiceTypeName">
                                        <button class="absolute p-2 ml-2 text-white rounded-md right-10 bg-slate-800 hover:bg-slate-500" wire:click="updateServiceType">Save</button>
                                    @else
                                        <div class="flex items-center ml-auto">
                                            <span class="absolute left-5">{{ $serviceTypes->serviceTypeName }}</span>
                                            <button class="p-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-500" wire:click="enterEditMode({{ $serviceTypes->serviceTypeID }})">Manage</button>
                                            <button class="p-2 ml-2 text-white bg-red-600 rounded-md hover:bg-red-500" wire:click="deleteServiceType({{ $serviceTypes->serviceTypeID }})">Delete</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        
        
        
       
        
        {{-- hidden form to add service type--}}
         <div id='inputForm' class="absolute top-0 bottom-0 left-0 right-0 items-center justify-center hidden bg-gray-800 bg-opacity-75" wire:ignore>
            <div class="block w-1/2 p-8 bg-white rounded-md">
                <div>
                    <label for="title" class="input-label">Service Type</label><br>
                    <input type="text" wire:model="serviceTypeName" class="w-full rounded-md">
                </div>
                <div class="mt-4">
                    <button class="p-2 mt-3 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='addServiceType'>Add</button>
                    <button class="p-2 text-white rounded-md bg-slate-700 hover:bg-gray-400 "onclick="toggleForm()">Cancel</button>
    
                    @include('utils.alert-error')
                </div>
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
</div>
