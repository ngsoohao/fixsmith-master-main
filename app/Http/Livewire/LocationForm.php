<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class LocationForm extends Component
{
    public $location;
    public $unitNo;
    public $street;
    public $city;
    public $state;
    public $postCode;
    public $locationID;
    public $malaysiaStates = [
        'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan',
        'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang', 'Perak',
        'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu',
    ];

    public function mount($locationid)
    {
        $this->location = Location::find($locationid);
        $this->unitNo = $this->location->unitNo;
        $this->street = $this->location->street;
        $this->city = $this->location->city;
        $this->state = $this->location->state;
        $this->postCode = $this->location->postCode;
        $this->locationID = $this->location->id;
    }

    public function render()
    {
        return view('livewire.location-form');
    }

    public function updateLocation()
    {
        $this->location->unitNo = $this->unitNo;
        $this->location->street = $this->street;
        $this->location->city = $this->city;
        $this->location->state = $this->state;
        $this->location->postCode = $this->postCode;
        $this->location->id = $this->locationID;
        $this->location->save();

        return redirect()->route('manage-location');
        
    }

    public function deleteLocation(){
        $this->location->delete();
        return redirect()->route('manage-location');
    }
}