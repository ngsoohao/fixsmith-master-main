<?php

namespace App\Http\Livewire;

use App\Models\Cases;
use Livewire\Component;

class ManageCase extends Component
{
    public $cases;
    public $title;
    public $description;
    public $status;
    public $feedback;


    public function render()
{
    // Load the Livewire view with the current user's cases
    $cases = Cases::all();
    return view('livewire.manage-case',['cases'=>$cases]);
}
    public function addCase()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $cases = new Cases();
        $cases->title = $this->title;
        $cases->description = $this->description;
        $cases->status = 'pending';
        $cases->feedback = 'pending for admin reply';
        $cases->id = auth()->user()->id;

        $cases->save();
        $this->resetFields();
        return redirect()->route('manage-case');
    }

    public function getUserCases()
    {
        // Retrieve cases belonging to the authenticated user
        $this->cases = Cases::where('id', auth()->user()->id)->get();
    }

    public function deleteCase($caseID)
    {
    Cases::find($caseID)->delete();
    }


    

    

    private function resetFields()
    {
        // Reset input fields to their default values
        $this->title = '';
        $this->description = '';
        $this->status = '';
        $this->feedback = '';
    }
}
