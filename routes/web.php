<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AirlineBookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Agents\AddAgent;
use App\Livewire\Agents\BookSales;
use App\Livewire\Agents\SalesByStatus;
use App\Livewire\Dealer\DealersByActivityStatus;
use App\Livewire\Dealer\DealersByStatus;
use App\Livewire\Dealer\Registration;
use App\Livewire\Dealer\RegistrationApproval;
use App\Livewire\Services\AddPassengerService;
use App\Livewire\Services\BillingDetailsService;
use App\Livewire\Services\FlightBookingService;
use Illuminate\Support\Facades\Route;

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
});

// page routes
Route::view('about-us', 'pages.about-us')->name('about-us');
Route::view('contact-us', 'pages.contact-us')->name('contact-us');

Route::middleware('auth', 'verified','registrationCheck')->group(function () {
    Route::get('dashboard', [HomeController::class, 'redirector'])->name('dashboard');
});

    Route::resource('adminActions', AdminController::class);
    // livewire routes
Route::middleware('auth')->group(function () {
    Route::get('dealer_register', Registration::class)->name('dealer_register');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('adminActions', AdminController::class);
    Route::resource('airlineBooking', AirlineBookingController::class);

    // livewire routes
Route::get('dealersByStatus/{status}', DealersByStatus::class)->name('dealersByStatus');
Route::get('dealersByActivityStatus/{status}', DealersByActivityStatus::class)->name('dealersByActivityStatus');
Route::get('agentsIndex', AddAgent::class)->name('agentsIndex');
Route::get('bookSales', BookSales::class)->name('bookSales');
Route::get('salesByStatus/{status}', SalesByStatus::class)->name('salesByStatus');
Route::get('flightBooking/{appID}', FlightBookingService::class)->name('flightBooking');
Route::get('addPassengers/{appID}', AddPassengerService::class)->name('addPassengers');
Route::get('billingDetails/{appID}', BillingDetailsService::class)->name('billingDetails');

// Email routes
Route::get('sendAuthorizationMail/{appID}', [MailController::class, 'authorizationMail'])->name('sendAuthorizationMail');


});

require __DIR__.'/auth.php';
