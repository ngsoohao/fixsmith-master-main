<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RateAndReview;



class ReviewHistory extends Component
{
    public $reviews;
    public array $editMode;
    public $reviewText;
    public $rating;
    
    public function mount()
    {
        $this->reviews = RateAndReview::where('id', auth()->id())
            ->with(['serviceProvider', 'user'])
            ->get();

        foreach ($this->reviews as $key => $value) {
            $this->reviewText[$value->reviewID] = '';
            $this->editMode[$value->reviewID] = false; // Initialize edit mode for each review
        }
    }


    public function enterEditMode($reviewID)
    {
        $this->editMode[$reviewID] = true;
    }

    public function cancelEdit($reviewID)
    {
        $this->editMode[$reviewID] = false;
        return redirect('review-history');
    }

    public function setRating($value){
        $this->rating = $value;
    }


    public function saveReview($reviewID){
        $reviewToEdit = RateAndReview::findOrFail($reviewID);
        $reviewToEdit->rating=$this->rating;
        $reviewToEdit->reviewText=$this->reviewText[$reviewID];
        $reviewToEdit->save();

        return redirect('review-history');
        
    }

    
    public function deleteReview($reviewID){
        RateAndReview::find($reviewID)->delete();
        return redirect('review-history');
    }

    

    public function render(){
        
        return view('livewire.review-history', ['reviews' => $this->reviews]);
    }
}
