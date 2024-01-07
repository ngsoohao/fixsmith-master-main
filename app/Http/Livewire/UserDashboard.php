<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserDashboard extends Component
{
    public function mount(){
        if(auth()->user()->role =='handymen'){
            return redirect('manage-payouts');
        }
        else if(auth()->user()->role =='user'){
            return redirect('user-manage-booking');
        }
        else if(auth()->user()->role =='admin'){
            return redirect('verify-handymen');
        }
    }
    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
