<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSideAllOrder extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $allOrders = Order::where('orderID', 'like', '%' . $this->search . '%')
            ->orWhere('id', 'like', '%' . $this->search . '%')
            ->orWhere('price','like','%'.$this->search.'%')
            ->orderBy('created_at', 'desc')
            ->with('location','serviceProvider')
            ->paginate(30);

            return view('livewire.admin-side-all-order', [
                'allOrders' => $allOrders
            ]);
        }
}
