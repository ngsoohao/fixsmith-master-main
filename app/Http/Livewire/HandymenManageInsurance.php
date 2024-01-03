<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\InsuranceRequest;
use App\Models\Order;

class HandymenManageInsurance extends Component
{
    public $insurances;
    public $showOrderDetails = [];
    public $declineReason;
    public $insuranceID;
    public $currentState=[];
    public $insuranceRequest=[];

    public function mount()
    {
        $this->insurances = Insurance::with('serviceProvider')
            ->where('status', 'active')
            ->whereHas('serviceProvider', function ($query) {
                $query->where('id', auth()->user()->id);
            })
            ->get();

        foreach ($this->insurances as $insurance) {
            $this->showOrderDetails[$insurance->orderID] = false;
            $insuranceRequest = InsuranceRequest::where('insuranceID', $insurance->insuranceID)->first();
            $this->currentState[$insurance->insuranceID] = $insuranceRequest ? $insuranceRequest->status : null;
        }

        //check the current status of this insurance request 
        
        

    }

    public function toggleOrderDetails($insuranceID)
    {
        $this->showOrderDetails[$insuranceID] = !$this->showOrderDetails[$insuranceID];
    }

    public function acceptClaimRequest($insuranceID){
        $insuranceRequest=InsuranceRequest::where('insuranceID',$insuranceID)->first();
        $insuranceRequest->status='accepted';
        $insuranceRequest->save();
        session()->flash('success','Schedule success');
        return redirect('handymen-manage-insurance');

    }

    public function rejectClaimRequest($insuranceID){
        $insuranceRequest=InsuranceRequest::where('insuranceID',$insuranceID)->first();
        $insuranceRequest->status='declined';
        $insuranceRequest->declineReason=$this->declineReason;
        session()->flash('alert','Request Declined');
        $insuranceRequest->save();
    }

    public function render()
    {
        return view('livewire.handymen-manage-insurance',[
            'insurances'=>$this->insurances,
        ]);
    }
}