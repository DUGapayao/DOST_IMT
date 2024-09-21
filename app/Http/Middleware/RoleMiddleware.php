<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public $accessLevel = [
        'executive' => 1,
        'planning-director' => 2,
        'planning-officer' => 3,
        'agency-head' => 4,
        'agency-focal' => 5,
        'view-only' => 6,
    ];

    public function handle(Request $request, Closure $next, $role): Response
    {
        if(Auth::user()->role == $role){
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
