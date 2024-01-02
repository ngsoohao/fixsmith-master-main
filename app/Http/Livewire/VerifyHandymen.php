<?php

namespace App\Http\Livewire;

use App\Models\IdentityDocument;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;


class VerifyHandymen extends Component
{
    public $imagePath;
    public $document;
    public $status;
    public $role;
    public $identityDocumentID;

    

    public function mount()
    {
        $this->document = IdentityDocument::where('status', 'pending')->get();
        foreach ($this->document as $key => $value) {
            $this->status[$value->identityDocumentID] = '';
        }
    }

    public function deleteDocument($identityDocumentID)
    {
    IdentityDocument::find($identityDocumentID)->delete();
    session()->flash('Deleted');
    }

    public function rejectDocument($identityDocumentID)
    {
        $this->document = IdentityDocument::find($identityDocumentID);
        $this->document->status='declined';
        $this->document->save();
    }
    public function approveDocument($identityDocumentID)
    {
        $this->document = IdentityDocument::find($identityDocumentID);
        $this->document->status='approved';
        Storage::delete($this->document->fileName);
        $this->document->save();
        $user = User::find($this->document->id);

        if($user){
            $user->role = "handymen";
            $user->save();
        }
        
        
        $this->deleteImageFromPath($identityDocumentID);

        
        return redirect()->route('verify-handymen');
    }



    public function getImagePath(){
        $documents = IdentityDocument::where('status', 'pending')->get();
    
        $imagePaths = [];
    
        foreach ($documents as $document) {
            if ($document && File::exists(storage_path('app/public/' . $document->fileName))) {
                $imagePath = asset('storage/' . $document->fileName);
                $imagePaths[] = [
                    'identityDocumentID' => $document->identityDocumentID,
                    'name' => $document->name,
                    'documentNumber' => $document->documentNumber,
                    'imagePath' => $imagePath,
                    'id'=>$document->id,
                ];
                //dd($imagePaths);
            }
        }
    
        $this->imagePath = $imagePaths; 
    
        return $this->imagePath;
    }
    
    public function deleteImageFromPath($identityDocumentID){
        $document = IdentityDocument::where('identityDocumentID', $identityDocumentID)->first();
    
        
            if ($document && $document->fileName) {
                //dd($imagePath);
                Storage::delete($document->fileName);

                session()->flash('success','Record Deleted');
                return redirect('verify-handymen');
            }
            else{
                session()->flash('alert','Cannot find Image');
                return redirect('verify-handymen');
            }
    
    }

    //&& File::exists(storage_path('app/public/' . $document->fileName))
    
    public function render()
    {
        $this->getImagePath();
        return view('livewire.verify-handymen');
    }
    
}