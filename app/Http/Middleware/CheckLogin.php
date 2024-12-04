<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        // Kullanıcıyı al
        $user = Auth::user();

        if ($user->role == 'admin' && $request->is('customer/*')) {
            return redirect('admin/mainpage');
        }

        if ($user->role == 'customer' && $request->is('admin/*')) {
            return redirect('customer/mainpage');
        }

        return $next($request);
    }
}
