<?php

namespace App\Http\Livewire;
use App\Models\Insurance;
use App\Models\Order;

use Livewire\Component;

class ViewInsuredOrders extends Component
{
    public $insuranceID;
    public $insuredOrders;
    public function mount($insuranceID){
        $this->insuranceID=$insuranceID;

        $insurance=Insurance::where('insuranceID',$insuranceID)->first();
        $this->insuredOrders=Order::where('orderID',$insurance->orderID)
        ->with('serviceProvider','location')
        ->first();
    }
    public function render()
    {
        return view('livewire.view-insured-orders',[
            'insuredOrders'=>$this->insuredOrders,
        ]);
    }
}
