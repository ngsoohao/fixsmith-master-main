<?php

namespace App\Http\Livewire;

use App\Mail\OrderCreated;
use Livewire\Component;
use App\Models\Location;
use App\Models\Order;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Mail;



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
    public bool $message;
    public $allOrderDate=[];
    public $allOrderTime=[];



    public function mount($serviceProviderID){
        $this->serviceProviderID= $serviceProviderID;
        $this->userLocations = Location::where('id', auth()->user()->id)->get();
    }

    public function newOrder(){
        $order = New Order;
        $order->price=$this->price;
        $order->orderDate=\Carbon\Carbon::parse($this->orderDate)->format('Y-m-d');
        $order->orderTime= \Carbon\Carbon::parse($this->orderTime)->format('H:i');
        $order->quoteMin=0;
        $order->quoteMax=0;
        $order->status='pending';
        $order->sessionID='';
        $order->serviceDescription=$this->serviceDescription;
        $order->locationID=$this->selectedLocationID;
        $order->serviceProviderID=$this->serviceProviderID;
        $order->id=auth()->User()->id;
        $order->save();

        $serviceProvider = ServiceProvider::where('serviceProviderID', $this->serviceProviderID)->first();
         if ($serviceProvider) {
            // Get the user associated with the ServiceProvider
            $serviceProviderUser = $serviceProvider->user;

            if ($serviceProviderUser) {
                // Ship the order and send email to the serviceProviderUser
                Mail::to($serviceProviderUser)->queue(new OrderCreated);
            }
        }
        session()->flash('success','Your Booking Has Been Created, we have notified the handymen');
        return redirect('user-manage-booking');

    }


    public function checkTimeAvailability(){
        $allServiceProviderOrders=Order::where('serviceProviderID',$this->serviceProviderID)
        ->whereIn('status',['quoted','paid'])
        ->get();
        //dd($allServiceProviderOrders);
        $this->message = false;


        foreach ($allServiceProviderOrders as $allServiceProviderOrder) {
            $this->orderDate=\Carbon\Carbon::parse($this->orderDate)->format('Y-m-d');

            $this->allOrderDate = $allServiceProviderOrder->orderDate;
            $this->allOrderTime = $allServiceProviderOrder->orderTime;
            //dd($this->orderDate);
            // dd($this->allOrderTime);

            if ($this->orderTime == $this->allOrderTime && $this->orderDate == $this->allOrderDate) {
                $this->message = true;
                break;

            }
            else{
                $this->message = false;
            }
        }
    }

    public function render()
    {

        return view('livewire.make-booking',[
            'userLocations' => $this->userLocations,
        ]);
    }
}
