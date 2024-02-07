<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegistrationCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(Auth::user()->organization_id == null){
        //     return redirect()->route('dealer_register');
        // }else{
        //      return $next($request);
        // }

        switch(Auth::User()->role)
        {
            case RoleEnum::DEALER->value:
                if(Auth::user()->organization_id == null){
                    return redirect()->route('dealerRegBusinessInfo', [
                        'userID' => Auth::user()->id,
                        'viewOnly' => 'NOVIEW'
                    ]);
                }else{
                     return $next($request);
                }
                break;
            case RoleEnum::AGENT->value:
                if(Auth::user()->organization_id == null){
                    return redirect()->route('dealer_register');
                }else{
                     return $next($request);
                }
                break;
            case RoleEnum::ADMIN->value:
                    $userID = null;
                    return $next($request);
                break;
            case RoleEnum::AFFILIATE->value:
                return $next($request);
                break;
        }
    }
}
