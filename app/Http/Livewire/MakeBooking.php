<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Order;


class MakeBooking extends Component
{
    public $serviceProviderID;
    public $order;
    public $price;
    public $serviceDescription;
    public $orderDate;
    public $orderTime;
    public $sessionID;
    public $selectedLocationID;
    public $userLocations;


    public function mount($serviceProviderID){
        $this->serviceProviderID= $serviceProviderID;
        $this->userLocations = Location::where('id', auth()->user()->id)->get();
    }

    public function newOrder(){
        $order = New Order;
        $order->price=$this->price;
        $order->orderDate=\Carbon\Carbon::parse($this->orderDate)->format('Y-m-d');
        $order->orderTime= \Carbon\Carbon::parse($this->orderTime)->format('H:i');
        $order->status='pending';
        $order->sessionID='';
        $order->serviceDescription=$this->serviceDescription;
        $order->locationID=$this->selectedLocationID;
        $order->serviceProviderID=$this->serviceProviderID;
        $order->id=auth()->User()->id;
        $order->save();

        return redirect('user-manage-booking');

    }


    public function render()
    {

        return view('livewire.make-booking',[
            'userLocations' => $this->userLocations,
        ]);
    }
}
