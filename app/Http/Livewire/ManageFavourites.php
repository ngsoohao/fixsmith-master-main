<?php

namespace App\Http\Livewire;

use App\Models\FavouriteList;
use Livewire\Component;

class ManageFavourites extends Component
{
    public $favouriteListName;
    public $editMode;
    public $allFavList;
    public $currentEditingID;
    public $editedFavouriteListName;
    
    public function mount()
    {
        $this->allFavList =FavouriteList::where('id',auth()->user()->id)->get();
    }

    public function enterEditMode($favouriteListID)
    {
        $this->editMode = true;
        $this->currentEditingID = $favouriteListID;

        // Find the corresponding FavouriteList for editing
        $favouriteList = FavouriteList::find($favouriteListID);
        $this->editedFavouriteListName = $favouriteList->favouriteListName;
    }

    public function exitEditMode(){
        $this->editMode=false;


    }
    public function newFavList(){
        $favouriteList=new FavouriteList();
        $favouriteList->favouriteListName=$this->favouriteListName;
        $favouriteList->id=auth()->user()->id;
        $favouriteList->save();

        return redirect('manage-favourites');

    }

    public function updateFavList($favouriteListID){
        $favouriteList=FavouriteList::find($favouriteListID);
        $favouriteList->favouriteListName=$this->editedFavouriteListName;
        $favouriteList->save();
        return redirect('manage-favourites');


    }

    public function deleteFavList($favouriteListID){
        FavouriteList::find($favouriteListID)->delete();
        return redirect('manage-favourites');
    }


    public function render()
    {
        return view('livewire.manage-favourites',[
            'allFavList'=> $this->allFavList,
        ]);
    }
}