<div>
    @livewireStyles
    @include('utils.sessionFlash')
    <div x-show="isOpen" class="fixed inset-0 flex items-center justify-center">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="z-50 p-8 bg-white rounded-md shadow-md">
            <span class="absolute cursor-pointer top-4 right-4" wire:click="closeModal">
                <i class="text-2xl text-gray-700 fas fa-times"></i>
            </span>
            
            <div class="mb-4 ">
                <div class="flex">
                    
                    <label for="insuranceOption" class="block mb-1 ml-2 text-lg">Would you like to add on protection for your booking? </label>
                </div>
                <div class="mt-4 mb-4 ml-4">
                    <p>The price of insurance would be 10 % of the quoted price</p>

                </div>
                <div class="flex items-center ml-4 ">
                    
                    <x-checkbox class="p-3 ml-2 mr-2 border-2 border-slate-500 " wire:click="toggleCheckBox" name="insuranceOption"/>
                    <p>Please click on the checkbox to add on protection</p>
                </div>
                

                
            </div>
            <p class="mb-4 text-md">Proceed to checkout?</p>
            
            <button class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400" wire:click="createCheckOutSession">Yes, Proceed</button>

            <button class="px-4 py-2 ml-2 text-gray-700 bg-gray-200 rounded-md" wire:click="returnRedirect">Cancel</button>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('openModal', () => {
                @this.openModal();
            });
        });
    </script>
    @livewireScripts
</div>