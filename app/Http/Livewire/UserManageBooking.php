<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\RateAndReview;
use App\Models\StripeConnectAccounts;


class UserManageBooking extends Component
{
    public $orders;
    public $orderHistory;

    public function mount(){
        $this->orders = Order::where('id', auth()->id())
        ->whereIn('status', ['pending', 'paid', 'quoted','delivered'])
        ->with(['location', 'serviceProvider', 'user'])
        ->get();

        $this->orderHistory = Order::where('id', auth()->id())
            ->whereIn('status', ['canceled','completed'])
            ->with(['location', 'serviceProvider', 'user'])
            ->get();
    }

    // public function checkReviewExist(){
        

    //     $completedOrders = Order::where('status', 'completed')->get();
    //     $this->existence = false;

    //     foreach ($completedOrders as $order) {
    //         $existingReview = RateAndReview::where('orderID', $order->orderID)->first();

    //         if ($order && $existingReview) {
    //         $this->existence = true;
            
    //         }
    //     }
    // }

    public function cancelOrder($orderID){
        $bookedOrder=Order::find($orderID);

        if ($bookedOrder && $bookedOrder->status == 'pending') {
            $bookedOrder->status = 'canceled';
            $bookedOrder->save();
        }
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

    public function render()
    {             
        return view('livewire.user-manage-booking', [
            'orders' => $this->orders,
            'orderHistory'=>$this->orderHistory]);

    }
}
