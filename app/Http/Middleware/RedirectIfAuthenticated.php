<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $role = null)
    {
        if (Auth::guard($role)->check()) {
            if ($role == 'users') {
                return redirect('dashboard');
            } elseif ($role == 'admin') {
                return redirect('admin/dashboard');
            }
        }
        return $next($request);
    }
}
