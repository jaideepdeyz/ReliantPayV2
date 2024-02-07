<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AirlineBookingController;
use App\Http\Controllers\DocusignController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProfileController;
use App\Livewire\AdminActions;
use App\Livewire\Agents\AddAgent;
use App\Livewire\Agents\BookSales;
use App\Livewire\Agents\SalesByStatus;
use App\Livewire\Dealer\DealerDashboard;
use App\Livewire\Dealer\DealersByActivityStatus;
use App\Livewire\Dealer\DealersByStatus;
use App\Livewire\Dealer\DealerShow;
use App\Livewire\Dealer\Registration;
use App\Livewire\Dealer\RegistrationApproval;
use App\Livewire\Services\AddPassengerService;
use App\Livewire\Services\BillingDetailsService;
use App\Livewire\Services\FlightBookingService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\OrganizationsController;
use App\Http\Controllers\AmtrakBookingController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\JwtDocuSignController;
use App\Http\Controllers\ZohoSignController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\ManageAffiliates;
use App\Livewire\Admin\ManageAgents;
use App\Livewire\Admin\ManageOrganizations;
use App\Livewire\Admin\ManageSales;
use App\Livewire\Affilate\AffilateDashboard;
use App\Livewire\Affilate\ManageMerchants;
use App\Livewire\Agents\AgentDashboard;
use App\Livewire\Agents\AuthorizedBookings;
use App\Livewire\Agents\UploadConfirmedTicket;
use App\Livewire\Dealer\ManageCustomers;
use App\Livewire\Dealer\PendingAuthorization;
use App\Livewire\Dealer\Registration\BankingDetails;
use App\Livewire\Dealer\Registration\BusinessInformation;
use App\Livewire\Dealer\Registration\Confirmation;
use App\Livewire\Dealer\Registration\DocumentUploads;
use App\Livewire\Dealer\Registration\ServicesCompliances;
use App\Livewire\Payment\MakePayment;
use App\Livewire\Registration\ByInvite;
use App\Livewire\Services\AmtrackBookingService;
use App\Livewire\Services\ChargeDetailService;
use App\Livewire\User\ResetPassword;
use App\Models\AmtrakBooking;

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
Route::get('reload-captcha', [App\Http\Controllers\CaptchaController::class, 'reloadCaptcha']);

// User Routes
Route::get('resetPassword', ResetPassword::class)->name('resetPassword');

//docusign routes
Route::get('docusign', [DocusignController::class, 'index'])->name('docusign');
Route::get('startSigning/{appID}', [DocusignController::class, 'startSigning'])->name('startSigning');
Route::get('connect-docusign', [DocusignController::class, 'connectDocusign'])->name('connect.docusign');
Route::get('docusign/callback', [DocusignController::class, 'callback'])->name('docusignCallback');
Route::get('sign-document', [DocusignController::class, 'signDocument'])->name('docusign.sign');
// jwt docusign routes
Route::get('authorizebooking/{id}', [JwtDocuSignController::class, 'authorizebooking'])->name('authorizebooking');
Route::get('checkAuthorizationForm/{appId}', [JwtDocuSignController::class, 'checkAuthorizationForm'])->name('checkAuthorizationForm');
// Zoho routes
Route::get('authorizeAndSend/{id}', [ZohoSignController::class, 'authorizeAndSend'])->name('authorizeAndSend');
Route::post('zohoWebhook', [ZohoSignController::class, 'zohoWebhook'])->name('zohoWebhook');
Route::get('checkAuthorizationFormStatus/{appId}', [ZohoSignController::class, 'checkAuthorizationFormStatus'])->name('checkAuthorizationFormStatus');
Route::get('registrationByInvitation/{code}', ByInvite::class)->name('registrationByInvitation');

// page routes
Route::view('about-us', 'pages.about-us')->name('about-us');
Route::view('contact-us', 'pages.contact-us')->name('contact-us');

Route::middleware(['auth', 'verified', 'registrationCheck'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'redirector'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Route::get('dealer_register', Registration::class)->name('dealer_register');

    // Dealer Registration Routes
    Route::get('dealerRegBusinessInfo/{userID}/{viewOnly}', BusinessInformation::class)->name('dealerRegBusinessInfo');
    Route::get('dealerServicesCompliances/{orgID}/{viewOnly?}', ServicesCompliances::class)->name('dealerServicesCompliances');
    Route::get('dealerBankingDetails/{orgID}/{viewOnly?}', BankingDetails::class)->name('dealerBankingDetails');
    Route::get('dealerDocs/{orgID}/{viewOnly?}', DocumentUploads::class)->name('dealerDocs');
    Route::get('confirmation/{orgID}/{viewOnly?}', Confirmation::class)->name('confirmation');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('dealers', DealerController::class);
    Route::resource('airlineBooking', AirlineBookingController::class);
    Route::resource('amtrakBookingDetails', AmtrakBookingController::class);

    // dealer routes
    Route::get('dealersByStatus/{status}', DealersByStatus::class)->name('dealersByStatus');
    Route::get('dealers/show/{orgID}', DealerShow::class)->name('dealers.show');
    Route::get('dealerDashboard', DealerDashboard::class)->name('dealerDashboard');
    Route::get('addAgent', AddAgent::class)->middleware('dealerApprovalCheck')->name('addAgent');
    Route::get('manageCustomers', ManageCustomers::class)->name('manageCustomers');
    Route::get('pendingAuthorizations', PendingAuthorization::class)->name('pendingAuthorizations');

    //admin Routes
    Route::get('adminDashboard', AdminDashboard::class)->name('adminDashboard');
    Route::get('manageOrganizations', ManageOrganizations::class)->name('manageOrganizations');
    Route::get('manageAgents', ManageAgents::class)->name('manageAgents');
    Route::get('manageSales', ManageSales::class)->name('manageSales');
    Route::get('manageAffiliates', ManageAffiliates::class)->name('manageAffiliates');

    //Affilate Routes
    Route::get('affiliateDashboard', AffilateDashboard::class)->name('affiliateDashboard');
    Route::get('manageMerchants', ManageMerchants::class)->name('manageMerchants');

    // Agents Routes
    Route::get('agentDashboard', AgentDashboard::class)->name('agentDashboard');
    Route::get('authorizedSales', AuthorizedBookings::class)->name('authorizedSales');


    Route::get('dealersByActivityStatus/{status}', DealersByActivityStatus::class)->name('dealersByActivityStatus');
    Route::get('bookSales', BookSales::class)->name('bookSales');
    Route::get('salesByStatus/{status}', SalesByStatus::class)->name('salesByStatus');
    Route::get('flightBooking/{appID}', FlightBookingService::class)->name('flightBooking');
    Route::get('amtrakBooking/{appID}', AmtrackBookingService::class)->name('amtrakBooking');
    Route::get('addPassengers/{appID}', AddPassengerService::class)->name('addPassengers');
    Route::get('addChargeDetails/{appID}', ChargeDetailService::class)->name('addChargeDetails');
    Route::get('billingDetails/{appID}', BillingDetailsService::class)->name('billingDetails');

    Route::get('uploadTicket/{appID}', UploadConfirmedTicket::class)->name('uploadTicket');

    // Email routes
    Route::get('sendAuthorizationMail/{appID}', [MailController::class, 'authorizationMail'])->name('sendAuthorizationMail');
    // payment routes
    Route::get('payment/stepOnePay/{id}', [App\Http\Controllers\PaymentController::class, 'stepOnePay'])->name('payment.stepOnePay');
    Route::get('payment/stepThreePay', [App\Http\Controllers\PaymentController::class, 'stepThreePay'])->name('payment.stepThreePay');
    Route::get('payment/generatePaymentLink/{id}', [App\Http\Controllers\PaymentController::class, 'generatePaymentLink'])->name('payment.generatePaymentLink');

    // PDF Routes
    Route::get('authorizationForm/{bookingID}', [App\Http\Controllers\PdfController::class, 'authorizationForm'])->name('authorizationForm');
});
// payment Link routes
Route::get('payment-link/{id}', [App\Http\Controllers\PaymentController::class, 'paymentLink'])->name('paymentLink');
Route::post('makePaymentLinkPayment',[App\Http\Controllers\PaymentController::class, 'makePaymentLinkPayment'])->name('makePaymentLinkPayment');

require __DIR__ . '/auth.php';
