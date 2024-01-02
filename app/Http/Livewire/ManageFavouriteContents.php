<?php

namespace App\Http\Livewire;

use App\Models\FavouriteListContent;
use Livewire\Component;

class ManageFavouriteContents extends Component
{
    public $favouriteListID;

    public function mount($favouriteListID){
        $this->favouriteListID=$favouriteListID;
    }

    public function deleteFavContent($favouriteListContentID)
    {
        FavouriteListContent::find($favouriteListContentID)->delete();
        session()->flash('success','favourite deleted');
        return redirect()->route('manage-favourite-contents', ['favouriteListID' => $this->favouriteListID]);
    }

    
    public function render()
    {
        $favListContents = FavouriteListContent::with('serviceProvider.user')
            ->where('favouriteListID', $this->favouriteListID)
            ->get();


        return view('livewire.manage-favourite-contents', compact('favListContents'));
    }
}