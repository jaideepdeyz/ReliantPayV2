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
        switch (Auth::User()->role) {
            case RoleEnum::ADMIN->value:
                return redirect()->route('adminDashboard');
                break;
            case RoleEnum::AFFILIATE->value:

                return redirect()->route('affiliateDashboard');

                break;
            case RoleEnum::DEALER->value:
                return redirect()->route('dealerDashboard');
                break;
            case RoleEnum::AGENT->value:
                if (Auth::User()->is_active == 'Yes') {
                    return redirect()->route('agentDashboard');
                } else {
                    Session::flush();
                    Auth::logout();

                    return redirect('login');
                }
                break;
            case RoleEnum::TICKETER->value:
                if (Auth::User()->is_active == 'Yes') {
                    return redirect()->route('manageTickets');
                } else {
                    Session::flush();
                    Auth::logout();
                    return redirect('login');
                }
                break;
            case RoleEnum::FINANCE->value;
            if (Auth::User()->is_active == 'Yes') {
                return redirect()->route('financeDash');
            } else {
                Session::flush();
                Auth::logout();
                return redirect('login');
            }
            break;
            default:
                return redirect()->route('login');
                break;
        }
    }
}
