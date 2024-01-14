<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceProvider;
use Livewire\WithPagination;

class AdminSideAllServiceProvider extends Component
{

    use WithPagination;
    public $search = '';

    public function render()
    {
        $allServiceProviders = ServiceProvider::where('serviceProviderID', 'like', '%' . $this->search . '%')
        ->orWhere('id', 'like', '%' . $this->search . '%')
        ->paginate(30);

        return view('livewire.admin-side-all-service-provider', [
            'allServiceProviders' => $allServiceProviders,
        ]);
    }
}
