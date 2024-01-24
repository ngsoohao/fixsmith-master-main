<?php

namespace App\Http\Livewire;

use App\Models\FavouriteListContent;
use App\Models\FavouriteList;
use App\Models\ServiceProfile;
use Livewire\Component;
use App\Models\ServiceProvider;
use App\Models\ServiceType;


class GetHandymenList extends Component
{
    public $serviceType;
    public $serviceTypeID;
    public $search;
    public $averageRating;
    public $serviceProviderID;
    public $favouriteListID;
    
    //compact var
    public $favLists;
    public $handymen;
    public $serviceProfiles=[];
    public $serviceTypeName;



    public function mount($serviceTypeID)
    {
        $this->serviceTypeID = $serviceTypeID;
        $this->favLists = FavouriteList::where('id', auth()->user()->id)->get();
        $this->handymen = ServiceProvider::with('user', 'reviews', 'serviceProfile')->where('serviceTypeID', $this->serviceTypeID)->get();
        $this->serviceTypeName=ServiceType::where('serviceTypeID',$serviceTypeID)->first();

        foreach ($this->handymen as $handyman) {
            // Store the serviceProfile in the array using serviceProviderID as the key
            $this->serviceProfiles[$handyman->serviceProviderID] = ServiceProfile::where('serviceProviderID', $handyman->serviceProviderID)->first();
        }
    }

    public function convertRatingToStars($rating)
    {
        $fullStars = floor($rating);
        $halfStar = round($rating - $fullStars, 1) > 0 ? 1 : 0;

        $starString = str_repeat('⭐', $fullStars) . ($halfStar ? '' : '');

        return $starString;
    }

    public function addFavourites($favouriteListID,$serviceProviderID){
        $favourites=new FavouriteListContent();
        $favourites->favouriteListID=$favouriteListID;
        $favourites->serviceProviderID=$serviceProviderID;
        $favourites->save();
        session()->flash('success', 'Favourites added');        
        return redirect()->route('get-handymen-list', ['serviceTypeID' => $this->serviceTypeID]);  
          
        
        
    }



    public function render()
    {
       
        
        
        return view('livewire.get-handymen-list',[
            'serviceTypes' => ServiceType::where('serviceTypeName', 'like', '%' . $this->search . '%')->paginate(14),
            'favLists'=>$this->favLists,
            'handymen'=>$this->handymen,
            'serviceProfile'=>$this->serviceProfiles,
        ]);
    }
}