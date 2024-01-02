<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceProfile;
use App\Models\ServiceProvider;


class ManageServiceProfile extends Component
{
    public $aboutMe;
    public $providedServiceDescription;
    public $serviceProviderID;
    public $userID;


    
    public function addDescription(){
        $this->validate([
            'aboutMe' => 'required',
            'providedServiceDescription' => 'required',
            'serviceProviderID' => 'unique:service_profiles',
        ], [
            'serviceProviderID.unique' => 'You have already added a service profile for this service type',
        ]);
        $serviceProfile=new ServiceProfile;
        $serviceProfile->aboutMe=$this->aboutMe;
        $serviceProfile->providedServiceDescription=$this->providedServiceDescription;
        $serviceProfile->serviceProviderID=$this->serviceProviderID;
        $serviceProfile->id=auth()->user()->id;
        $serviceProfile->save();
        session()->flash('success','Your Profile Has Been Updated.');
        return redirect('manage-service-profile');
    }

    public function editDescription($serviceProfileID){
        $editedServiceProfile=ServiceProfile::find($serviceProfileID);
        $editedServiceProfile->aboutMe=$this->aboutMe;
        $editedServiceProfile->providedServiceDescription=$this->providedServiceDescription;
        $editedServiceProfile->save();
        session()->flash('success','This profile has been updated');
        return redirect('manage-service-profile');
    }

    public function deleteDescription(){
    }

    public function render()
    {
        $addedServiceProfiles = ServiceProfile::with('ServiceProvider')
            ->where('id',auth()->user()->id)
            ->get();

        $providedServices = ServiceProvider::with('serviceType')
            ->where('id', auth()->user()->id)
            ->get();
            return view('livewire.manage-service-profile', compact('providedServices','addedServiceProfiles'));
        
          
    }
}