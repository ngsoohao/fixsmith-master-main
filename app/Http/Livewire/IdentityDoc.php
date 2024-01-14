<?php

namespace App\Http\Livewire;
use App\Models\IdentityDocument;
use App\Models\ServiceType;
use App\Models\ServiceProvider;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\WithPagination;




class IdentityDoc extends Component
{

    use WithFileUploads;
    use WithPagination;


    //identity doc table var
    public $fileName;
    public $document;
    public $image;
    public $name;
    public $documentNumber;
    public $imagePath;
    public bool $existence;
    //serviceProvider table var\
    public $serviceType;
    public $serviceTypeID;
    public $search ='';
    public $userID;
    public $showUploadSection = false;
    public $addedServiceProvider;



    public function mount(){
        $this->addedServiceProvider=ServiceProvider::with('serviceType')
        ->where('id',auth()->user()->id)
        ->get();
    }
    public function addNewApplication()
    {
        if (auth()->check()){
            $this->validate([
                'fileName' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
                'name' =>'required|string|max:100',
                'documentNumber'=>'required|numeric',
                
            ]);

        $document= new IdentityDocument();
        $document->id = auth()->User()->id;
        $document->name=$this->name;
        $document->documentNumber=$this->documentNumber;
        $document->status = 'pending';
        $filePath=$this->fileName->store('storage/','public');
        $document->fileName=$filePath;

        $document->save();
        
  
        session()->flash('message', 'File uploaded.');
        }
        else{
            return redirect()->route('login');
        }
        
    }

    public function next(){
        $this->showUploadSection = true;
    }

    public function checkDocumentExistence()
    {
        $submitUserID = auth()->user()->id;
        $existingDocument = IdentityDocument::where('id', $submitUserID)->first();

        if($existingDocument){
            $this->existence=true;
        }
        else{
            $this->existence=false;
        }
        
    }


    public function addServiceProvider()
    {
        if (auth()->check()) {
            $userID = auth()->user()->id;
            $selectedServiceTypeName = $this->search;

            $existingServiceProvider = ServiceProvider::where('id', $userID)
                ->whereHas('serviceType', function ($query) use ($selectedServiceTypeName) {
                    $query->where('serviceTypeName', $selectedServiceTypeName);
                })
                ->first();

            if ($existingServiceProvider) {
                session()->flash('alert','you have already added this service type');
                return redirect('upload-identity-doc');
            }

            $serviceProvider = new ServiceProvider();
            $serviceProvider->id = $userID;

            $selectedServiceType = ServiceType::where('serviceTypeName', $selectedServiceTypeName)->first();

            if ($selectedServiceType) {
                $serviceProvider->serviceTypeID = $selectedServiceType->serviceTypeID;
                $serviceProvider->save();
            } else {
                return redirect()->back()->with('error', 'Invalid service type selected.');
            }

            return redirect('upload-identity-doc');
        } else {
            return redirect()->route('login');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function deleteAddedService($serviceProviderID){
        // Find the ServiceProvider record by ID
        $serviceProvider = ServiceProvider::find($serviceProviderID);

        if ($serviceProvider) {
            // Delete the ServiceProvider record
            $serviceProvider->delete();

            return redirect('upload-identity-doc');
            
        }

    }

    
    public function render()
    {   $this->checkDocumentExistence();
        $userId = auth()->user()->id;

        return view('livewire.identity-doc',[
            'serviceTypes' => ServiceType::where('serviceTypeName','like','%'.$this->search.'%')->paginate(10),

            'addedServiceDetails' => $this->addedServiceProvider,
        ]);
    }
}
