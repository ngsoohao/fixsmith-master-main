<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class ManageLocation extends Component
{

    public $locations;
    public $unitNo;
    public $street;
    public $city;
    public $state;
    public $postCode;
    public $showAddForm = false;
    public $malaysiaStates = [
        'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan',
        'Melaka', 'Negeri Sembilan', 'Pahang', 'Penang', 'Perak',
        'Perlis', 'Putrajaya', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu',
    ];
    


    public function render()
    {
        $this->getUserLocations();
        return view('livewire.manage-location');
    }

    public function addLocation()
    {

        $this->validate([
            'unitNo' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required', 
            'postCode' => 'required|numeric',
        ]);

        $locations= new Location();
        $locations->unitNo = $this->unitNo;
        $locations->street = $this->street;
        $locations->city = $this->city;
        $locations->state = $this->state;
        $locations->postCode = $this->postCode;

        //get logged-in user id as reference
        $locations->id = auth()->User()->id;

        $locations->save();
        $this->resetForm();
        session()->flash('success','New address added sucessfully!');
        return redirect()->route('manage-location');
        
        
    }

    public function getUserLocations()
    {
        $this->locations = Location::where('id', auth()->user()->id)->get();
        
    }


    //manage add location form method

    //1
    public function showForm(){
        $this->showAddForm = !$this->showAddForm;
        $this->resetForm();
    }
    //2
    public function resetForm(){
        $this->unitNo = '';
        $this->street = '';
        $this->city = '';
        $this->state = '';
        $this->postCode = '';
    }

    
    

    
}