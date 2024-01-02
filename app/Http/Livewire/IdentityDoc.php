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
    public $serviceProvider;
    public $serviceType;
    public $serviceTypeID;
    public $search ='';
    public $userID;
    public $showUploadSection = false;



    public function mount(){
        
    }
    public function addNewApplication()
    {
        if (auth()->check()){
            $this->validate([
                'fileName' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
                
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


    public function addServiceProvider(){

        if (auth()->check()) {
            $serviceProvider=new ServiceProvider();
            $serviceProvider->id=auth()->User()->id;
            $selectedServiceTypeID = ServiceType::where('serviceTypeName', $this->search)->first();
    
                if ($selectedServiceTypeID) {
                    $serviceProvider->serviceTypeID=$selectedServiceTypeID->serviceTypeID;
                    $serviceProvider->save();
                } 
            
                return redirect('upload-identity-doc');
            
        }
        else{
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

        // Check if the record exists before attempting to delete
        if ($serviceProvider) {
            // Delete the ServiceProvider record
            $serviceProvider->delete();

            // Refresh the Livewire component to reflect the updated list
            $this->render();
        }

    }

    
    public function render()
    {   $this->checkDocumentExistence();
        
        return view('livewire.identity-doc',[
            'serviceTypes' => ServiceType::where('serviceTypeName','like','%'.$this->search.'%')->paginate(10),
            'addedServiceDetails' => ServiceType::whereIn('serviceType.serviceTypeID', function ($query) {
                $query->select('service_providers.serviceTypeID')
                    ->from('service_providers')
                    ->where('service_providers.id', auth()->user()->id);
            })
            ->join('service_providers', 'serviceType.serviceTypeID', '=', 'service_providers.serviceTypeID')
            ->select('serviceType.*', 'service_providers.serviceProviderID as serviceProviderID')
            ->get(),
        ]);
    }
}
