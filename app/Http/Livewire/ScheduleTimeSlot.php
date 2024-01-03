<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceProvider;


class ScheduleTimeSlot extends Component
{
    public $serviceProviderID;
    public $specificTime;
    public $isTimeSlotAvailable;

    public function mount($serviceProviderID){
        $this->serviceProviderID=$serviceProviderID;
    }
    
    public function checkTimeSlotAvailability()
    {
        $serviceProvider = ServiceProvider::findOrFail($this->serviceProviderID);

        // Check if the time slot is available
        $this->isTimeSlotAvailable = $serviceProvider->isTimeSlotAvailable($this->specificTime);
    }

    public function render()
    {
        return view('livewire.schedule-time-slot');
    }
}
