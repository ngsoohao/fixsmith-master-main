<div class="mb-4 mr-4">
    @livewireStyles
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
            
            <div class="flex-row pt-5 mx-2">
                        
                <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400 text-md" wire:click="updateLocation">Update</button>
                <button class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-400 text-md" onclick="showConfirmation()">Delete</button>
                
                        
            </div>
            @include('utils.alert-error')
        </div>

        <!--The hidden confirmation before delete-->
        <div id="confirmationDialog" class="fixed inset-0 z-50 hidden overflow-y-auto overlay">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Heroicon name: exclamation -->
                                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c.54 0 1.063-.2 1.466-.564.402-.363.628-.852.628-1.36V11.36c0-.51-.226-.999-.628-1.363a1.933 
                                    1.933 0 0 0-1.466-.563H6.465A1.95 1.95 0 0 0 5 9.36V19a2 2 0 0 0 2 2zm-2-6l6-6 6 6"></path>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Delete Confirmation
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this location?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <!-- Add a click event to perform the delete action -->
                        <button wire:click="deleteLocation({{$location->locationID}})" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                        <button onclick="hideConfirmation()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function showConfirmation() {
                document.getElementById('confirmationDialog').classList.remove('hidden');
            }

            function hideConfirmation() {
                document.getElementById('confirmationDialog').classList.add('hidden');
            }
        </script>
    @livewireScripts
</div>








