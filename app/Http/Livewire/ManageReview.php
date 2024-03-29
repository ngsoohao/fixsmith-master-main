<?php

namespace App\Http\Livewire;

use App\Models\RateAndReview;
use App\Models\Order;
use App\Models\ServiceProvider;
use Livewire\Component;

class ManageReview extends Component
{
    public $reviewText;
    public float $rating;
    public $serviceProviderID;
    public $orderID;
    public $averageRating;
    

    
    protected $rules = [
        'reviewText' => 'required|min:5',
        'rating' => 'required|numeric|between:1,5',
    ];

    public function mount($orderID){
        $this->orderID=$orderID;
    }

    public function newReview($orderID){
        $order=Order::where('orderID',$orderID)->first();

        //check if there is existing review
        $userReview=RateAndReview::where('orderID',$this->orderID)->get();
        foreach($userReview as $review){
            if($orderID == $review->orderID){
                session()->flash('alert','you have already added review for this order');
                return redirect('user-manage-booking');
            }
        }
        $review=new RateAndReview;
        $review->reviewText=$this->reviewText;
        $review->rating=$this->rating;
        $review->orderID=$this->orderID;
        $review->serviceProviderID=$order->serviceProviderID;
        $review->id=auth()->user()->id;
        session()->flash('success', 'Review submitted successfully!');
        $review->save();


        $existedReviews=RateAndReview::where('id',auth()->user()->id)->get();
        foreach($existedReviews as $existedReview){
            if($review->orderID==$existedReview->orderID){
                session()->flash('alert','you have already reviewed this order');
                return redirect('review-history');
            }
        }
        
        
        $this->refreshAverageRating($orderID);
        return redirect('user-manage-booking');

    }

    private function refreshAverageRating($orderID)
    {
        $order = Order::where('orderID', $orderID)->first();

        if ($order) {
            // Get all reviews for the service provider
            $allRatings = RateAndReview::where('serviceProviderID', $order->serviceProviderID)->get();
            $reviewsCount = $allRatings->count();

            if ($reviewsCount > 0) {
                // Calculate the total rating
                $totalRating = $allRatings->sum('rating');
                
                // Calculate the average rating
                $averageRating = $totalRating / $reviewsCount;

                // Update the service provider with the new average rating
                $serviceProvider = ServiceProvider::find($order->serviceProviderID);
                $serviceProvider->averageRating = $averageRating;
                $serviceProvider->save();
            } else {
                // If there are no reviews, set averageRating to 0 or handle it based on your business logic
                $serviceProvider = ServiceProvider::find($order->serviceProviderID);
                $serviceProvider->averageRating = 0;
                $serviceProvider->save();
            }
        }
    }

    public function render()
    {
        $this->refreshAverageRating($this->orderID);
        return view('livewire.manage-review');
    }
}
