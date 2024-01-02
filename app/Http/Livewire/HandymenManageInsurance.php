<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Insurance;
use App\Models\Order;

class HandymenManageInsurance extends Component
{
    public $insurances;
    public $showOrderDetails = [];

    public function mount()
    {
        $this->insurances = Insurance::with('serviceProvider')
            ->where('status', 'requested')
            ->whereHas('serviceProvider', function ($query) {
                $query->where('id', auth()->user()->id);
            })
            ->get();

        foreach ($this->insurances as $insurance) {
            $this->showOrderDetails[$insurance->id] = false;
        }

    }

    public function toggleOrderDetails($insuranceID)
    {
        $this->showOrderDetails[$insuranceID] = !$this->showOrderDetails[$insuranceID];
    }

    public function render()
    {
        return view('livewire.handymen-manage-insurance',[
            'insurances'=>$this->insurances,
        ]);
    }
}