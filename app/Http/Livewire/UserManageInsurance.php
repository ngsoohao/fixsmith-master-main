<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\Order;

class UserManageInsurance extends Component
{
    public $insurances;
    public $orderDetails;

    public function mount(){
        $this->insurances=Insurance::where('id',auth()->user()->id)->get();
        

        $this->orderDetails = Order::where('id',auth()->user()->id)
        ->whereIn('orderID', $this->insurances->pluck('orderID'))
        ->with('location','serviceProvider')
        ->get();    

        

    }

    public function render()
    {
        return view('livewire.user-manage-insurance',[
            'insurances'=>$this->insurances,
            'orderDetails'=>$this->orderDetails,
        ]);
    }
}
