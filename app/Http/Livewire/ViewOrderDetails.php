<?php

namespace App\Http\Livewire;
use App\Models\Order;

use Livewire\Component;

class ViewOrderDetails extends Component
{
    public $orders;

    public function mount($orderID){
        $this->orders=Order::where('orderID',$orderID)->first();
    }
    public function render()
    {
        return view('livewire.view-order-details');
    }
}