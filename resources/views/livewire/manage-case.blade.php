<div class="flex h-screen">
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="mr-5 border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")
    </div>
    
    <div class="flex-grow w-6/7">
        <div class="p-2 ml-2">
            <div class="flex flex-row">
                <h1 class="text-xl font-bold">Manage Cases</h1>
                <button onclick="toggleForm()" class="absolute p-2 text-white rounded-md right-20 bg-slate-700 hover:bg-slate-400">Submit Case</button>
            </div>
            
            <div id="inputForm" class="absolute top-0 bottom-0 left-0 right-0 items-center justify-center hidden bg-gray-800 bg-opacity-75" wire:ignore>
                <div class="w-3/4 p-8 bg-white rounded-md">
                    <div>
                        <label for="title" class="input-label">Title</label><br>
                        <input type="text" wire:model="title" class="w-full rounded-md">
                    </div>
                    <div class="mt-4">
                        <label for="description" class="input-label">Description</label><br>
                        <textarea wire:model='description' class="w-full h-48 rounded-md"></textarea>
                    </div>
                    <div class="mt-4">
                        <button class="p-2 mt-3 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='addCase'>Submit</button>
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
            <div class="mt-5">
                <div class="">
                   <livewire:retrieve-case>
                </div>
            </div>
        </div>
    </div>
</div>
