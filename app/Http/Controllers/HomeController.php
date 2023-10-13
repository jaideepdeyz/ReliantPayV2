<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirector()
    {
        switch(Auth::User()->role){
            case RoleEnum::ADMIN->value:
                return view('adminDashboard');
                break;
            case RoleEnum::DEALER->value:
                if(Auth::User()->is_approved == 'Yes')
                {
                    return view('dealerDashboard');
                } else {
                    return view('submittedDealerDashboard');
                }
                break;
            case RoleEnum::AGENT->value:
                return redirect()->route('sales.dashboard');
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }
}
