<div>
    @livewireStyles

    <div class="flex h-screen">
        <div class="mr-5 border-r-2 w-1/7 border-slate-400">
            @include("nav.side-nav")            
        </div>
        <div class="w-6/7">
            

            <div class="flex flex-row ">
                @if ($bankAccount)
            
                @if($editMode)
                <!-- Edit mode with input fields -->
                <form wire:submit.prevent="updateBankAccount" class="p-5 mt-10 mr-5 border-2 rounded-md border-slate-400">
                    <label for="editAccountNumber">Account Number:</label>
                    <input wire:model="editAccountNumber" type="text" id="editAccountNumber" class="mb-2 border-2 rounded-md border-slate-400"><br>
        
                    <label for="editBankName">Bank Name:</label>
                    <input wire:model="editBankName" type="text" id="editBankName" class="mb-2 border-2 rounded-md border-slate-400"><br>
        
                    <label for="editAccountHolderName">Account Holder Name:</label>
                    <input wire:model="editAccountHolderName" type="text" id="editAccountHolderName" class="mb-2 border-2 rounded-md border-slate-400"><br>
        
                    <div class="flex flex-row pt-2">
                        <button type="submit" class="p-2 text-white border-2 rounded-md bg-slate-800 hover:bg-slate-500">Save</button>
                        <button wire:click.prevent="cancelEdit" class="p-2 text-white bg-red-600 border-2 rounded-md hover:bg-red-500">Cancel</button>
                    </div>
                </form>

                @else
                    <div class="p-5 mt-10 mr-5 border-2 rounded-md border-slate-400">
                        <p>Account Number: {{ $bankAccount->accountNumber }}</p>
                        <p>Bank Name: {{ $bankAccount->bankName }}</p>
                        <p>Account Holder Name: {{ $bankAccount->accountHolderName }}</p>
        
                        <div class="flex flex-row pt-2">
                            <button wire:click.prevent="enterEditMode" class="p-2 text-white border-2 rounded-md bg-slate-800 hover:bg-slate-500">Edit</button>
                            <button wire:click.prevent="deleteBankAccount" class="p-2 text-white bg-red-600 border-2 rounded-md hover:bg-red-500">Delete</button>
                        </div>

                    </div>
                    
                @endif
                    
                    
                @else
                
                <div>
                    <div class="form-group">
                        <label for="bankName" class="input-label ">Bank Name</label><br>
                        <input type="text" wire:model="bankName" class="rounded-md input-field">
                    </div>
                    <div class="form-group">
                        <label for="accountHolderName" class="input-label ">Account Holder Name</label><br>
                        <input type="text" wire:model="accountHolderName" class="rounded-md input-field">
                    </div>
                    <div class="form-group">
                        <label for="accountNumber" class="input-label ">Account Number</label><br>
                        <input type="text" wire:model="accountNumber" class="rounded-md input-field">
                    </div>
                    <div class="form-group">
                        <button class="p-2 mt-3 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='addBankAccount'>Submit</button>
                    </div>
                    @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>
                @endif
            </div>
            
    
        </div>
    </div>
    @livewireScripts
</div>
