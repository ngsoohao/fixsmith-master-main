<?php

namespace App\Http\Livewire;

use App\Models\StripeConnectAccounts;
use Livewire\Component;

class ManagePayouts extends Component
{
    public $accountID;


    public function mount(){

    }

    public function addStripeConnect(){
        $stripe=new \Stripe\StripeClient(env('SECRET_TESTMODE_APIKEY'));
        $account = $stripe->accounts->create(['type' => 'standard']);
        $this->accountID=$account->id;
    
        $link=$stripe->accountLinks->create([
            'account' => $account->id,
            //only use http in test mode, https in production 
            'refresh_url' => 'http://127.0.0.1:8000/manage-payouts',
            'return_url' => 'http://127.0.0.1:8000/manage-payouts',
            'type' => 'account_onboarding',
        ]);

        $stripeConnectAccount = new StripeConnectAccounts;
        $stripeConnectAccount->connectedAccountID=$account->id;
        $stripeConnectAccount->stripeConnectURL=$link->url;
        $stripeConnectAccount->id=auth()->user()->id;
        $stripeConnectAccount->save();
        
        return redirect()->to($link->url);    

        
       


    }

    public function render()
    {
        $linkAccount=StripeConnectAccounts::where('id',auth()->user()->id)->first();
        return view('livewire.manage-payouts',compact('linkAccount'));
    }
}
