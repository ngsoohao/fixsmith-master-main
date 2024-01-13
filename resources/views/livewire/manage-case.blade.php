<div class="min-h-screen lg:flex sm:block md:block">
    @livewireStyles

    <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")
    </div>
    
    <div class="flex-grow w-6/7">
        <div class="p-2 ml-2">
            <div class="flex flex-row">
                <h1 class="text-xl font-bold">Manage Cases</h1>
                <div x-data="{open:false}" x-cloak>
                    <button @click="open = true" class="absolute p-2 text-white rounded-md right-20 bg-slate-700 hover:bg-slate-400">Submit Case</button>

                    <div x-show="open" class="fixed top-0 bottom-0 left-0 right-0 flex items-center justify-center bg-gray-800 bg-opacity-75">
                        <div class="w-3/4 p-8 bg-white rounded-md">
                            <h1 class="text-lg font-bold">Add A New Case</h1>

                            <div>
                                <label>Select a category</label><br>
                                <select  wire:model="category" class="rounded-md">
                                    <option value="order">Order</option>
                                    <option value="payment">Payment</option>
                                    <option value="insurance">Insurance</option>
                                    <option value="handymen">Handymen</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="title" class="input-label">Title</label><br>
                                <input type="text" wire:model="title" class="w-full rounded-md">
                            </div>
                            <div class="mt-4">
                                <label for="description" class="input-label">Description</label><br>
                                <textarea wire:model='description' class="w-full h-48 rounded-md"></textarea>
                            </div>
                            <div class="mt-4">
        
                                @include('utils.alert-error')
        
                                <button class="p-2 mt-3 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='addCase'>Submit</button>
                                <button class="p-2 text-white rounded-md bg-slate-700 hover:bg-gray-400 " @click='open=false'>Cancel</button>
        
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-5">
                <div class="">
                <livewire:retrieve-case>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</div>
