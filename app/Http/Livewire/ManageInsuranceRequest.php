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
    public $imagePath;
    public $uploadedImages;
    public $submittedClaim;
    public $claimExistence;

    public function mount($insuranceID){
        $this->insuranceID=$insuranceID;        
        $this->getImagePath($insuranceID);
        $this->checkInsuranceRequestExistence($insuranceID);
    }

    public function newInsuranceRequest(){
        $insuranceReq= new InsuranceRequest;
        $insuranceReq->title=$this->title;
        $insuranceReq->description=$this->description;
        $insuranceReq->insuranceID=$this->insuranceID;
        $insuranceReq->save();

        $insurance=Insurance::where('insuranceID',$this->insuranceID)->first();
        $insurance->status='requested';
        $insurance->save();

        
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

    public function uploadImages($insuranceID){
      
            $path = $this->image->store('InsuranceReqImg', 'public');

            $insuranceReqImg = new InsuranceRequestImage;
            $insuranceReqImg->imagePath=$path;
            $insuranceReqImg->insuranceID =$insuranceID;
            $insuranceReqImg->save();
    }
    

    public function render()
    {
        return view('livewire.manage-insurance-request',[
            'imagePath'=>$this->imagePath,
            'submittedClaim'=>$this->submittedClaim,
            
        ]);
    }
}