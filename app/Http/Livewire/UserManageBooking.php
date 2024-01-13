<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\StripeConnectAccounts;
use App\Models\Cases;


class UserManageBooking extends Component
{
    public $orders;
    public $orderHistory;

    public function mount(){
        $this->orders = Order::where('id', auth()->id())
        ->whereIn('status', ['pending', 'paid', 'quoted','delivered','scheduled','price updated'])
        ->with(['location', 'serviceProvider', 'user'])
        ->get();

        $this->orderHistory = Order::where('id', auth()->id())
            ->whereIn('status', ['canceled','completed'])
            ->with(['location', 'serviceProvider', 'user'])
            ->get();
    }

    public function cancelOrder($orderID){
        $bookedOrder=Order::find($orderID);

        if ($bookedOrder && $bookedOrder->status == 'pending') {
            $bookedOrder->status = 'canceled';
            $bookedOrder->save();
        }
    }

    public function acceptQuotedRange($orderID){
        $acceptQuoteRangeOrder=Order::find($orderID);
        if($acceptQuoteRangeOrder->status == 'quoted'){
            $acceptQuoteRangeOrder->status = 'scheduled';
            $acceptQuoteRangeOrder->save();
            session()->flash('success','you have accepted the quote');
        }
        else{
            session()->flash('alert','fail, unable to proceed');
        }
        
        return redirect('user-manage-booking');

    }

    public function orderComplete($orderID){
        $orderForPayouts=Order::where('orderID',$orderID)
        ->with('serviceProvider')
        ->first();

        $stripe= new \Stripe\StripeClient(env('SECRET_TESTMODE_APIKEY'));
        $handymenStripeAccount= StripeConnectAccounts::where('id',$orderForPayouts->serviceProvider->id)->first();
        $stripe->accounts->update(
            $handymenStripeAccount->connectedAccountID,
            ['settings' => ['payouts' => ['schedule' => ['interval' => 'manual']]]]
        );

        $stripe->transfers->create(
            [
              'amount' => ($orderForPayouts->price*100),
              'currency' => 'myr',
              'destination' => $handymenStripeAccount->connectedAccountID,

            ]
        );

        session()->flash('success','payment has been released to handymen');

        $deliveredOrder=Order::find($orderID);

        if ($deliveredOrder && $deliveredOrder->status == 'delivered') {
        $deliveredOrder->status = 'completed';
        $deliveredOrder->save();
        }

        return redirect('user-manage-booking');
    }

    public function appealIncompleteOrder($orderID){
        $userID=auth()->user()->id;
        $newCase= new Cases;
        $newCase->category='order';
        $newCase->title='Service Imcomplete Appeal';
        $newCase->description='userID: '.$userID.' orderID: '.$orderID;
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
        return view('livewire.user-manage-booking', [
            'orders' => $this->orders,
            'orderHistory'=>$this->orderHistory]);

    }
}
