<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\StripeConnectAccounts;

class HandymenManageBooking extends Component
{
    public $orderID;
    public $price=[];
    public $quoteMin=[];
    public $quoteMax=[];
    public $status;
    public $existence;
    public $orders;
    public $jobHistory;


    public function mount(){
        $handymanId = auth()->id();

        $this->orders = Order::whereHas('serviceProvider', function ($query) use ($handymanId) {
                $query->where('id', $handymanId);
            })
            ->whereIn('status', ['pending', 'quoted', 'paid', 'delivered','scheduled','price updated'])
            ->with(['location', 'serviceProvider', 'user'])
            ->get();

        $this->jobHistory = Order::where('id', auth()->id())
            ->whereIn('status', ['canceled', 'completed','declined'])
            ->with(['location', 'serviceProvider', 'user'])
            ->get();
    }

    public function acceptAndQuote($orderID){
        $incomingOrder=Order::find($orderID);

        if ($incomingOrder && $incomingOrder->status == 'pending') {
            $incomingOrder->status = 'quoted';
            $incomingOrder->quoteMin=$this->quoteMin[$orderID];
            $incomingOrder->quoteMax=$this->quoteMax[$orderID];
            $incomingOrder->save();
            session()->flash('success','you have quoted and accept an order');
        }
        return redirect('handymen-manage-booking');

    }

    public function declineIncomingOrder($orderID){
        $incomingOrder=Order::find($orderID);

        if ($incomingOrder && $incomingOrder->status == 'pending') {
            $incomingOrder->status = 'declined';
            $incomingOrder->save();
            session()->flash('alert','you have declined the order');
        }
        return redirect('handymen-manage-booking');
    }

    public function updateFinalPrice($orderID){
        $pendingFinalPriceOrder=Order::find($orderID);
        if($pendingFinalPriceOrder->status == "scheduled"){
            $pendingFinalPriceOrder->price = $this->price;
            $pendingFinalPriceOrder->status='price updated';
            $pendingFinalPriceOrder->save();
            session()->flash('success','the final price has been updated');
        }
        else{
            session()->flash('alert','fail please contact admin');
        }

        return redirect('handymen-manage-booking');

    }

    public function jobDone($orderID){
        $incomingOrder=Order::find($orderID);

        if ($incomingOrder && $incomingOrder->status == 'paid') {
            $incomingOrder->status = 'delivered';
            $incomingOrder->save();
        }
        return redirect('handymen-manage-booking');

    }


public function render()
{
    $stripeConnectStatus=StripeConnectAccounts::where('id',auth()->user()->id)->first();

    return view('livewire.handymen-manage-booking',[
        
        'orders' => $this->orders,
        'jobHistory'=>$this->jobHistory,
        'stripeConnectStatus'=>$stripeConnectStatus,
        
    ]);
}
}