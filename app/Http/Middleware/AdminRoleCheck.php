<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next): Response
    {
        switch (Auth::user()->role) {
            case RoleEnum::ADMIN->value:
            case RoleEnum::SADMIN->value:
                return $next($request);
            default:
                return redirect()->route('dashboard');
        }
    }
}
