<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait
{
    public function chekGuard($request)
    { //لو الجارد اللي جي مش موجود حوله للويب
        return in_array($request->type, ['student', 'parent', 'teacher']) ?  $request->type : 'web';
    }

    public function redirect($request) //intended بعد مايعمل لوجين هاته عند آخر حاجة وقف عندها وكان
    {
        if ($request->type == 'student') { 
            return redirect()->intended(RouteServiceProvider::STUDENT);
        } elseif ($request->type == 'parent') {
            return redirect()->intended(RouteServiceProvider::PARENT);
        } elseif ($request->type == 'teacher') {
            return redirect()->intended(RouteServiceProvider::TEACHER);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}
