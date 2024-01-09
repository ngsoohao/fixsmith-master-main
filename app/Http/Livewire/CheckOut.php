<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Insurance;


class CheckOut extends Component
{
    public $orderID;
    public $quotedOrder;
    public $status;
    public $order;
    //var for insurance
    public bool $insuranceOption=false;
    public $insurancePrice;

    
    public function mount($orderID){
        $this->orderID=$orderID;
        
    }

    public function createCheckOutSession()
    {
        $stripe = new \Stripe\StripeClient(env('SECRET_TESTMODE_APIKEY'));
        
        // Use first() to get the first matching order
        $this->order = Order::where('orderID', $this->orderID)->first();
        if (!$this->order) {
            session()->flash('alert','Payment Fail ,order does not exist');
            return redirect('user-manage-booking');
        }
        else{

            if($this->insuranceOption==true){
                $this->addInsurance($this->orderID);
                $this->insurancePrice=($this->order->price)*0.1;
            }
            
            $totalAmount=(($this->order->price)+$this->insurancePrice)*100;
        }
    
        $checkout_session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card', 'fpx'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'myr',
                    'product_data' => [
                        'name' => 'fixsmith',
                    ],
                    'unit_amount' =>$totalAmount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('user-manage-booking'),
            'cancel_url' => route('user-manage-booking'),

        ]);
    
        if($this->insuranceOption==true){
            $insurance= Insurance::where('orderID',$this->order->orderID)->first();
            $insurance->paidAmount=$this->insurancePrice;
            $insurance->status="active";
            $insurance->save();
        }
        
        return redirect()->to($checkout_session->url);   
        $this->quotedOrder = $this->order;
        $this->quotedOrder->status = 'paid';
        $this->quotedOrder->sessionID=$checkout_session->id;
        $this->quotedOrder->save();
        session()->flash('success','Payment Successful'); 
    }
    
    public function addInsurance($orderID){
        $insurance=New Insurance;
        $insurance->status='pending';
        $insurance->orderID=$orderID;
        $insurance->paidAmount= 0;
        $insurance->startDate=\Carbon\Carbon::parse($this->order->orderDate)->format('Y-m-d');
        $insurance->expiredDate = \Carbon\Carbon::parse($insurance->startDate)->addWeek()->format('Y-m-d');
        $insurance->id=auth()->user()->id;
        $insurance->serviceProviderID=$this->order->serviceProviderID;
        $insurance->save();
    }

    //this function is to toggle the bool between true and false
    public function toggleCheckBox(){
        $this->insuranceOption = !$this->insuranceOption;
    }

    public function returnRedirect(){
        return redirect('user-manage-booking');
    }
    
    public function render()
    {
        return view('livewire.check-out');
    }
}