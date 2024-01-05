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
    public $category;


    public function mount(){
        $this->cases = Cases::where('id', auth()->user()->id)->get();

    }
  
    public function addCase()
    {

        $this->validate([
            'title' => 'required | max:100',
            'description' => 'required | max:3000',
            'category' => 'required',
            
        ]);

        $cases = new Cases();
        $cases->category=$this->category;
        $cases->title = $this->title;
        $cases->description = $this->description;
        $cases->status = 'pending';
        $cases->feedback = 'pending for admin reply';
        $cases->id = auth()->user()->id;
        $cases->save();
        return redirect()->route('manage-case');
    }

    public function deleteCase($caseID)
    {
    Cases::find($caseID)->delete();
    session()->flash('success','this case has been deleted');
    }

    public function render()
    {
        return view('livewire.manage-case',[
            'cases'=>$this->cases]);
    } 
}
