<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cases;


class RetrieveCase extends Component
{
    public $cases;
    public $caseID;
    public $title;
    public $description;
    public $status;
    public $userID;


    public function deleteCase($caseID)
    {
    Cases::find($caseID)->delete();
    $this->emit('caseDeleted');
    }

    public function mount()
    {
    $this->userID = auth()->user()->id;
    }

    public function getUserCases()
    {
    // Retrieve cases belonging to the authenticated user
    $this->cases = Cases::where('id', $this->userID)->get();
    }

    public function render()
    {
        $this->getUserCases();
        return view('livewire.retrieve-case');
    }


    
}