<?php

use App\Http\Livewire\AdminSideAllOrder;
use App\Http\Livewire\AdminSideAllServiceProvider;
use App\Http\Livewire\ManageCase;
use App\Http\Livewire\ManageLocation;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ReplyCase;
use App\Http\Livewire\IdentityDoc;
use App\Http\Livewire\VerifyHandymen;
use App\Http\Livewire\ManageBankAccount;
use App\Http\Livewire\ManageServiceType;
use App\Http\Livewire\RetrieveServiceType;
use App\Http\Livewire\GetHandymenList;
use App\Http\Livewire\MakeBooking;
use App\Http\Livewire\CheckOut;
use App\Http\Livewire\UserDashboard;
use App\Http\Livewire\HandymenManageBooking;
use App\Http\Livewire\HandymenManageInsurance;
use App\Http\Livewire\ManageInsuranceRequest;
use App\Http\Livewire\ManageFavourites;
use App\Http\Livewire\ManageFavouriteContents;
use App\Http\Livewire\ManagePayouts;
use App\Http\Livewire\ManageReview;
use App\Http\Livewire\ManageServiceProfile;
use App\Http\Livewire\ReviewHistory;
use App\Http\Livewire\UserManageBooking;
use App\Http\Livewire\UserManageInsurance;
use App\Http\Livewire\ViewInsuredOrders;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
     Route::get('/user-dashboard',UserDashboard::class)->name('user-dashboard');

});

//Routes for admin
Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':admin'], function () {
    Route::get('/reply-case',ReplyCase::class)->name('reply-case'); 
    Route::get('/all-orders',AdminSideAllOrder::class)->name('all-orders'); 
    Route::get('/all-service-providers',AdminSideAllServiceProvider::class)->name('all-service-providers'); 


    


});

//Routes for handymen only
Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':handymen'], function () {
    Route::get('/manage-bank', ManageBankAccount::class)->name('manage-bank');
    Route::get('/handymen-manage-booking',HandymenManageBooking::class)->name('handymen-manage-booking');
    Route::get('/manage-service-profile',ManageServiceProfile::class)->name('manage-service-profile');
    Route::get('/handymen-manage-insurance',HandymenManageInsurance::class)->name('handymen-manage-insurance');
    Route::get('manage-payouts',ManagePayouts::class)->name('manage-payouts');




});

//Routes shared by handymen and user
Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':handymen|user'], function () {
    Route::get('/manage-location', ManageLocation::class)->name('manage-location');
    Route::get('/manage-case', ManageCase::class)->name('manage-case');
    Route::get('/make-booking/{serviceProviderID}',MakeBooking::class)->name('make-booking');
    Route::get('/user-manage-booking',UserManageBooking::class)->name('user-manage-booking');
    Route::get('/manage-review/{orderID}',ManageReview::class)->name('manage-review');
    Route::get('/review-history',ReviewHistory::class)->name('review-history');
    Route::get('/manage-favourites',ManageFavourites::class)->name('manage-favourites');
    Route::get('/manage-favourite-contents/{favouriteListID}',ManageFavouriteContents::class)->name('manage-favourite-contents');
    Route::get('/user-manage-insurance',UserManageInsurance::class)->name('user-manage-insurance');
    Route::get('/insurance-request/{insuranceID}',ManageInsuranceRequest::class)->name('manage-insurance-request');
    Route::get('/view-insured-orders/{insuranceID}',ViewInsuredOrders::class)->name('view-insured-orders');








   
});

//Routes for user only
Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':user'], function () {

});


//general routes
Route::get('/dashboard',function(){return view("dashboard");})->middleware('auth','verified')->name('dashboard');
Route::get('/retrieve-service-type',RetrieveServiceType::class)->name('retrieve-service-type');
Route::get('/get-handymen-list/{serviceTypeID}',GetHandymenList::class)->name('get-handymen-list');
Route::get('/checkout/{orderID}',CheckOut::class)->name('checkout');


//temp routes placements

Route::get('/verify-handymen', VerifyHandymen::class)->name('verify-handymen');
Route::get('/manage-service-type',ManageServiceType::class)->name('manage-service-type');
Route::get('/upload-identity-doc', IdentityDoc::class)->name('upload-identity-doc');






