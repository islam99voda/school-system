<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) { //if user is not logged in, redirect to dashboard
            if (request()->routeIs('student/dashboard')) {
                return route('selection');
            }
            elseif(request()->routeIs('/teacher/dashboard')) {
                return route('selection');
            }
            elseif(request()->routeIs('/parent/dashboard')) {
                return route('selection');
            }
            
        }
    }
}
