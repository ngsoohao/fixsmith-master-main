<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\InsuranceRequest;
use App\Models\Order;
use App\Models\Cases;

class UserManageInsurance extends Component
{
    public $insurances;
    public $orderDetails;
    public $currentState;
    public $insuranceHistories;

    public function mount(){
        $this->insurances = Insurance::where('id', auth()->user()->id)
        ->whereIn('status',['active','pending'])
        ->get();

        foreach ($this->insurances as $insurance) {
            $insuranceRequest = InsuranceRequest::where('insuranceID', $insurance->insuranceID)->first();
            $this->currentState[$insurance->insuranceID] = $insuranceRequest ? $insuranceRequest->status :'';
        }

        $this->insuranceHistories = Insurance::where('id', auth()->user()->id)
        ->whereIn('status',['claimed','expired'])
        ->get();

    }

    public function appealIncompleteInsurance($insuranceID){
        $userID=auth()->user()->id;
        $newCase= new Cases;
        $newCase->category='insurance';
        $newCase->title='Service Imcomplete Appeal';
        $newCase->description='userID: '.$userID.' insuranceID: '.$insuranceID;
        $newCase->feedback='Please Wait for Admin to Contact You Via Email or Calls';
        $newCase->status='pending';
        $newCase->id=$userID;
        $newCase->save();

        // $appealedOrder=Order::find($orderID);
        // $appealedOrder->status='appealed';

        session()->flash('success','appeal submitted for review');
        return redirect('manage-case');
    }

    public function render()
    {
        return view('livewire.user-manage-insurance',[
            'insurances'=>$this->insurances,
        ]);
    }
}
