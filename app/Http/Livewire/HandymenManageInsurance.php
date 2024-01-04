<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\InsuranceRequest;
use Livewire\WithFileUploads;
class HandymenManageInsurance extends Component
{
    use WithFileUploads;

    public $insurances;
    public $declineReason;
    public $insuranceID;
    public $currentState=[];
    public $insuranceRequest=[];
    public $serviceProof;
    public $insuranceHistories;

    public function mount()
    {
        $this->insurances = Insurance::with('serviceProvider')
        ->where('status', 'active')
        ->whereHas('serviceProvider', function ($query) {
            $query->where('id', auth()->user()->id);
        })
        ->get();

        $this->insuranceHistories = Insurance::with('serviceProvider')
        ->where('status',['claimed','expired'])
        ->whereHas('serviceProvider', function ($query) {
            $query->where('id', auth()->user()->id);
        })
        ->get();

        foreach ($this->insurances as $insurance) {
            $insuranceRequest = InsuranceRequest::where('insuranceID', $insurance->insuranceID)->first();
            $this->currentState[$insurance->insuranceID] = $insuranceRequest ? $insuranceRequest->status : null;
        }

        //check the current status of this insurance request 
        
        

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

    public function completeClaimRequest($insuranceID){
        $insuranceRequest=InsuranceRequest::where('insuranceID',$insuranceID)->first();
        $path=$this->serviceProof->store('ServiceProof','public');
        $insuranceRequest->serviceProof=$path;
        $insuranceRequest->status='completed';

        if($insuranceRequest->serviceProof == !NULL){
            //update the insurance item after the request completed
            $claimedInsurance=Insurance::where('insuranceID',$insuranceID)->first();
            $claimedInsurance->status="claimed";
            $claimedInsurance->save();

            $insuranceRequest->save();
            session()->flash('success','Service Completed, status updated successfully');
            return redirect('handymen-manage-insurance');

        }
        else{
            session()->flash('alert','status update fail, please make sure you have uploaded the service proof image');
            return redirect('handymen-manage-insurance');
        }

    }

    public function render()
    {
        return view('livewire.handymen-manage-insurance',[
            'insurances'=>$this->insurances,
            'insuranceHistories'=>$this->insuranceHistories,
        ]);
    }
}