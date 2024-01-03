<?php

namespace App\Http\Livewire;

use App\Models\Insurance;
use App\Models\InsuranceRequest;
use App\Models\InsuranceRequestImage;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageInsuranceRequest extends Component
{
    use WithFileUploads;

    public $image;
    public $insuranceID;
    public $title;
    public $description;
    public $imagePath=[];
    public $uploadedImages;
    public $submittedClaim;
    public $claimExistence;
    public $currentState;

    public function mount($insuranceID){
        $this->insuranceID=$insuranceID;        
        $this->getImagePath($insuranceID);
        $this->checkInsuranceRequestExistence($insuranceID);

        //check the current status of this insurance request 
        $insuranceRequest=InsuranceRequest::where('insuranceID',$insuranceID)->first();
        if($insuranceRequest){
            $this->currentState=$insuranceRequest->status;
        }
        
        
    }

    public function newInsuranceRequest(){

        //create new insurance request   
        $insuranceReq= new InsuranceRequest;
        $insuranceReq->title=$this->title;
        $insuranceReq->description=$this->description;
        $insuranceReq->insuranceID=$this->insuranceID;
        $insuranceReq->status='requested';
        $insuranceReq->save();
        //upload image
        $insuranceReqImg=new InsuranceRequestImage;
        $path = $this->image->store('InsuranceReqImg', 'public');
        $insuranceReqImg->imagePath=$path;
        $insuranceReqImg->insuranceID =$this->insuranceID;
        $insuranceReqImg->save();
        return redirect('manage-insurance-request');

        
    }

    public function checkInsuranceRequestExistence($insuranceID){
        $this->submittedClaim = InsuranceRequest::where('insuranceID', $insuranceID)->first();

        if($this->submittedClaim){
            $this->claimExistence=true;
        }
        else{
            $this->claimExistence=false;
        }
    }

    public function getImagePath($insuranceID){
        $documents = InsuranceRequestImage::where('insuranceID',$insuranceID)->get();
    
        $imagePaths = [];
    
        foreach ($documents as $document) {
            if ($document && File::exists(storage_path('app/public/' . $document->imagePath))) {
                $imagePath = asset('storage/' . $document->imagePath);
                $imagePaths[] = [
                    'imageDescription' => $document->imageDescription,
                    'imagePath' => $imagePath,
                ];
                //dd($imagePaths);
            }
        }
    
        $this->imagePath = $imagePaths; 
    
        return $this->imagePath;
    }
    

    public function render()
    {
        return view('livewire.manage-insurance-request',[
            'imagePath'=>$this->imagePath,
            'submittedClaim'=>$this->submittedClaim,
            
        ]);
    }
}