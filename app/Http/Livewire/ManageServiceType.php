<?php

namespace App\Http\Livewire;

use App\Models\ServiceType;
use Livewire\Component;

class ManageServiceType extends Component
{
    public $serviceTypeName;
    public $serviceType;
    public $editMode=false;
    public $selectedServiceTypeId;
    public $editedServiceTypeName;
    protected $debug = true;



    public function addServiceType(){
        $this->validate([
            'serviceTypeName' => 'required|string',
        ]);
        
        
        $serviceType= new ServiceType();
        $serviceType->serviceTypeName=$this->serviceTypeName;
        $serviceType->save();
    }
    
    public function updateServiceType()
    {
        $this->validate([
            'editedServiceTypeName' => 'required|string',
        ]);

        $serviceType = ServiceType::find($this->selectedServiceTypeId);
        $serviceType->serviceTypeName = $this->editedServiceTypeName;
        $serviceType->save();

        $this->resetEditMode();
    }

    public function resetEditMode()
    {
        $this->editMode = false;
        $this->selectedServiceTypeId = null;
        $this->editedServiceTypeName = '';
    }

    public function deleteServiceType($serviceTypeID){
        ServiceType::find($serviceTypeID)->delete();
    }

    public function enterEditMode($serviceTypeId)
    {
        $this->editMode = true;
        $this->selectedServiceTypeId = $serviceTypeId;
        $this->editedServiceTypeName = ServiceType::find($serviceTypeId)->serviceTypeName;
    }

    public function cancelEdit()
    {
        $this->editMode = false;
    }
    public function render()
    {
        $this->serviceType = ServiceType::all();
        return view('livewire.manage-service-type');
    }

}
