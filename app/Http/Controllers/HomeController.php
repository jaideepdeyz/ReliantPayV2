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
                return view('admin.adminDashboard');
                break;
            case RoleEnum::DEALER->value:
                if(Auth::User()->is_approved == 'Yes')
                {
                    return view('dealers.dealerDashboard');
                } else {
                    return view('dealers.submittedDealerDashboard');
                }
                break;
            case RoleEnum::AGENT->value:
                if(Auth::User()->is_active == 'Yes')
                {
                    return redirect()->route('agentDashboard');
                }
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }
}
