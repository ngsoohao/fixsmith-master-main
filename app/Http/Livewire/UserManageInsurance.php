<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\InsuranceRequest;
use App\Models\Order;

class UserManageInsurance extends Component
{
    public $insurances;
    public $orderDetails;
    public $currentState;

    public function mount(){
        $this->insurances = Insurance::where('id', auth()->user()->id)->get();
        foreach ($this->insurances as $insurance) {
            $insuranceRequest = InsuranceRequest::where('insuranceID', $insurance->insuranceID)->first();
            $this->currentState[$insurance->insuranceID] = $insuranceRequest ? $insuranceRequest->status :'';
        }
    }

    public function render()
    {
        return view('livewire.user-manage-insurance',[
            'insurances'=>$this->insurances,
        ]);
    }
}
