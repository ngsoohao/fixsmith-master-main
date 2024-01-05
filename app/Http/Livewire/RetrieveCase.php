<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cases;


class RetrieveCase extends Component
{
    public $cases;    


    public function mount()
    {
    $this->cases = Cases::where('id',auth()->user()->id)->get();

    }

   

    public function render()
    {
        return view('livewire.retrieve-case',[
            'cases'=>$this->cases,
        ]);
    }


    
}