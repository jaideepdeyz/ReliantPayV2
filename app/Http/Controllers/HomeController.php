<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function redirector()
    {
        switch(Auth::User()->role){
            case RoleEnum::ADMIN->value:
                // $authorizations = SaleBooking::where('app_status', StatusEnum::AUTHORIZED->value)->latest()->take(5)->get();
                // $bookings = SaleBooking::where('app_status', '!=', StatusEnum::DRAFT->value)->latest()->take(5)->get();
                // return view('admin.adminDashboard', compact('authorizations', 'bookings'));
                return redirect()->route('adminDashboard');
            case RoleEnum::DEALER->value:
                    return redirect()->route('dealerDashboard');
            case RoleEnum::AGENT->value:
                if(Auth::User()->is_active == 'Yes')
                {
                    return redirect()->route('agentDashboard');
                }else{
                    Session::flush();
                    Auth::logout();

                    return redirect('login');
                }
            default:
                return redirect()->route('login');
        }
    }
}
