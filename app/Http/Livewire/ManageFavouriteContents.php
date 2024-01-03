<?php

namespace App\Http\Livewire;

use App\Models\FavouriteListContent;
use Livewire\Component;

class ManageFavouriteContents extends Component
{
    public $favouriteListID;
    public $favListContents;

    public function mount($favouriteListID){
        $this->favouriteListID=$favouriteListID;
        $this->favListContents = FavouriteListContent::with('serviceProvider.user')
            ->where('favouriteListID', $favouriteListID)
            ->get();
    }

    public function deleteFavContent($favouriteListContentID)
    {
        FavouriteListContent::find($favouriteListContentID)->delete();
        session()->flash('success','favourite deleted');
        return redirect()->route('manage-favourite-contents', ['favouriteListID' => $this->favouriteListID]);
    }

    
    public function render()
    {
        


        return view('livewire.manage-favourite-contents',[
            'favListContents'=>$this->favListContents,
        ]);
    }
}