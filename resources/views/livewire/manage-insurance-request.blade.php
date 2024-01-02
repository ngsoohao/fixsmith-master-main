<div class="py-2 ">
    @livewireStyles
    @if ($claimExistence==false) 
        <div class="rounded-lg bg-zinc-200">
            <form class="max-w-2xl mx-auto">
                <h1 class="text-xl font-bold ">Please Tell Us What Happened</h1>
                <div class="mt-2">
                    <div class="mb-2">
                        <h2 class="text-md">Title</h2>
                        <input type="text" wire:model='title' class="w-full">
                    </div>
                    <div class="mb-2">
                        <h2 class="text-md">Please describe the problem you after encountered.</h2>
                        <textarea wire:model='description' class="w-full"></textarea>
                    </div>
            
                    <div class="mb-2">
                        <h2 class="text-md">Could you please provide us photos for references</h2>
    
                        <form >
                            <input type="file" wire:model="image" class="mt-2">
                            <button wire:click='uploadImages({{ $insuranceID }})'>Upload Images</button>
                        
                            <h2 class="mt-2 text-lg font-bold ">Preview</h2>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="preview" class="mt-4" width="200" height="200">
                            @endif
                        
                            @if ($imagePath)
                                <div>
                                    <h4>Uploaded Images:</h4>
                                    <div class="flex">
                                        @foreach ($imagePath as $imagePaths)
                                        <div class="">
                                            <img src="{{ $imagePaths['imagePath'] }}" alt="Identity Document" width="200" height="200">
    
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                </div>
                            @endif
                        </form>
                    </div>
                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="newInsuranceRequest">Submit</button>
                </div>
                
            </form>
        </div>
    @else
        
        <div class="rounded-lg bg-zinc-200">
            <div class="max-w-2xl mx-auto">
                <h1 class="text-xl font-bold ">Your Claim Request Has Been Submitted</h1>

                
                    <div class="pb-2">

                        <div class="mb-2">
                            <h2 class="text-md">Title</h2>
                            <div class="p-2 bg-white rounded-md ">
                                {{ $submittedClaim->title }}
                            </div>
                        </div>

                        <div class="mb-2">
                            <h2 class="text-md">Description</h2>
                            <div class="p-2 bg-white rounded-md ">
                                {{ $submittedClaim->description }}
                            </div>                     
                        </div>

                        <div class="mb-2">
                            <h2 class="text-md">Uploaded Images</h2>
                            @if ($imagePath)
                                
                                    <div class="flex">
                                        @foreach ($imagePath as $imagePaths)
                                        <div class="">
                                            <img src="{{ $imagePaths['imagePath'] }}" alt="Identity Document" width="200" height="200">

                                        </div>
                                        @endforeach
                                    </div>

                            @else
                            <p class="p-2 bg-white rounded-md">you did not upload any image</p>
                            @endif


                        </div>
                
                        
                    </div>
                
                
            </div>
        </div>
    @endif

    @livewireScripts
</div>