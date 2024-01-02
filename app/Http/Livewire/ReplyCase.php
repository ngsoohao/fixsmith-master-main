<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cases;


class ReplyCase extends Component
{
    public $cases;
    public $caseID;
    public $title;
    public $description;
    public array $feedback;
    public $status;


    public function mount()
    {
        $this->cases = Cases::where('status', 'pending')->get();
        //initial array
        foreach ($this->cases as $key => $value) {
            $this->feedback[$value->caseID] = '';
        }
    }



    public function updateCase($caseID)
    {
        
        $this->cases = Cases::find($caseID);
        $this->cases->feedback= $this->feedback[$caseID];
        $this->cases->status='resolved';
        $this->cases->save();

        return redirect()->route('reply-case');
    }


    public function render()
    {
        return view('livewire.reply-case', ['cases' => Cases::all()]);
    }
}
