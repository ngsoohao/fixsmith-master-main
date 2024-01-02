<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\RateAndReview;


class UserManageBooking extends Component
{
    public bool $existence;

    public function checkReviewExist(){
        

        // Assuming 'completed' is the status indicating a completed order
        $completedOrders = Order::where('status', 'completed')->get();

        foreach ($completedOrders as $order) {
            if ($order->review) {
                // Review exists for this completed order
                $this->existence=true;
            }
            else{
                $this->existence=false;
            }
        }
    }

    public function cancelOrder($orderID){
        $bookedOrder=Order::find($orderID);

        if ($bookedOrder && $bookedOrder->status == 'pending') {
            $bookedOrder->status = 'canceled';
            $bookedOrder->save();
        }
    }

    public function orderComplete($orderID){
        $deliveredOrder=Order::find($orderID);

        if ($deliveredOrder && $deliveredOrder->status == 'delivered') {
            $deliveredOrder->status = 'completed';
            $deliveredOrder->save();
        }
    }
    public function render()
    {
        $this->checkReviewExist();
        $orders = Order::where('id', auth()->id())
            ->whereIn('status', ['pending', 'paid', 'quoted','delivered'])
            ->with(['location', 'serviceProvider', 'user'])
            ->get();

        $orderHistory = Order::where('id', auth()->id())
            ->whereIn('status', ['canceled','completed'])
            ->with(['location', 'serviceProvider', 'user'])
            ->get();
        return view('livewire.user-manage-booking', ['orders' => $orders],['orderHistory'=>$orderHistory]);

    }
}
