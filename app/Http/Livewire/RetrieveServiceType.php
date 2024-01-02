<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ServiceType;
use Livewire\WithPagination;


class RetrieveServiceType extends Component
{
    use WithPagination;

    public $serviceTypeName;
    public $serviceType;
    public $search = '';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->serviceType = ServiceType::all();
        return view('livewire.retrieve-service-type',[
            'serviceTypes' => ServiceType::where('serviceTypeName','like','%'.$this->search.'%')->paginate(14),
        ]);
    }
}
