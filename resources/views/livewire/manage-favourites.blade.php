<div>
    @livewireStyles

    <div class="h-screen sm:block lg:flex ">
        <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-400">
            @include("nav.side-nav")            
        </div>
        <div class="flex-grow w-6/7">
            <h1 class="text-xl font-bold">Favourites</h1>
            <section x-data="{ open: false }" x-cloak>
                <button class="absolute p-2 text-white rounded-md right-20 bg-slate-700 hover:bg-slate-400" @click="open = true">Add New Favourite List</button>
         
                <div x-show="open"  class="fixed inset-0 bg-black bg-opacity-50">
                    <div @click.outside="open = false" class="fixed items-center p-8 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-md top-1/2 left-1/2">
                        <label>Please Insert Your New List Name</label><br>
                        <input wire:model="favouriteListName" wire:ignore class="mx-auto rounded-md">
                        <div class="flex gap-4 mt-4 sm:flex-cols-1 md:flex-cols-2">
                            <button class="px-4 py-2 text-white rounded-md right-20 bg-slate-700 hover:bg-slate-400" @click="open=false" wire:click="newFavList">Add</button>
                            <button class="px-4 py-2 text-white rounded-md right-20 bg-slate-700 hover:bg-slate-400" @click="open=false">Cancel</button>
                        </div>
                    </div>
                </div>

            </section>
            {{-- Section for listing the existing favourite list --}}
            <section class="mt-20 ">
                <div x-data="{editing=false}">
                    @foreach ($allFavList as $favouriteList)
                        <div class="flex p-4 mt-5 rounded-md shadow-md bg-slate-300">
                            @if ($editMode && $favouriteList->favouriteListID == $currentEditingID)
                                <input wire:model="editedFavouriteListName" class="flex-grow rounded-md">
                                <button class="p-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:ignore  wire:click="updateFavList({{$favouriteList->favouriteListID}})">Save</button>
                                <button class="p-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="exitEditMode">Cancel</button>
                            @else
                                <span class="flex-grow">{{ $favouriteList->favouriteListName }}</span>
                                <a class="p-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" href="{{route('manage-favourite-contents',[$favouriteList->favouriteListID])}}">Manage List</a>
                                <button class="p-2 ml-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:ignore wire:click="enterEditMode({{ $favouriteList->favouriteListID }})">Edit</button>
                                <button class="p-2 ml-2 text-white bg-red-700 rounded-md hover:bg-red-400" wire:ignore wire:click="deleteFavList({{ $favouriteList->favouriteListID }})">Delete</button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        @livewireScripts
    </div>