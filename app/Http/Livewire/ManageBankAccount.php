<?php

namespace App\Http\Livewire;

use App\Models\BankAccount;
use Illuminate\Auth\Events\Login;
use Livewire\Component;

class ManageBankAccount extends Component
{
    public $bankAccount;
    public $accountNumber;
    public $bankName;
    public $accountHolderName;
    public $editMode = false;
    public $editAccountNumber;
    public $editBankName;
    public $editAccountHolderName;
    
    

    public function addBankAccount(){
        $this->validate([
            'accountNumber' => 'required|numeric|unique:bankaccount',
            'bankName' => 'required|string',
            'accountHolderName' => 'required|string',
        ]);
        
        
        $bankAccount= new BankAccount();
        $bankAccount->bankName=$this->bankName;
        $bankAccount->accountNumber = $this->accountNumber;
        $bankAccount->accountHolderName=$this->accountHolderName;
        $bankAccount->id = auth()->User()->id;
        $bankAccount->save();
    }

    public function enterEditMode()
    {
        // Enter edit mode
        $this->editMode = true;
        $this->editAccountNumber = $this->bankAccount->accountNumber;
        $this->editBankName = $this->bankAccount->bankName;
        $this->editAccountHolderName = $this->bankAccount->accountHolderName;
    }

    public function cancelEdit()
    {
        // Cancel edit mode
        $this->editMode = false;
    }

    public function updateBankAccount()
    {
        // Validate and update bank account details
        $this->validate([
            'editAccountNumber' => 'required|numeric|unique:bankaccount,accountNumber,' . $this->bankAccount->id,
            'editBankName' => 'required|string',
            'editAccountHolderName' => 'required|string',
        ]);

        // Update the bank account details
        $this->bankAccount->update([
            'accountNumber' => $this->editAccountNumber,
            'bankName' => $this->editBankName,
            'accountHolderName' => $this->editAccountHolderName,
        ]);

        // Exit edit mode
        $this->editMode = false;
    }

    public function deleteBankAccount()
    {
        if ($this->bankAccount) {
            $this->bankAccount->delete();
        }

        $this->displayBankAccount();
    }



    public function displayBankAccount(){
        if(auth()->check()){
            $this->bankAccount = BankAccount::where('id', auth()->User()->id)->first();

        }
        else{
            return redirect('login');
        }
        
    
    }

    public function render()
    {
        $this->displayBankAccount();
        return view('livewire.manage-bank-account');
    }
}
