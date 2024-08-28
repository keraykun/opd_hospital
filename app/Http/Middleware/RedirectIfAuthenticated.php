<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch (auth()->user()->is_role) {
                    case 'patient':
                        return redirect()->route('patient.appointment.index');
                        break;
                    case 'doctor':
                        return redirect()->route('doctor.dashboard.index');
                        break;
                    case 'admin':
                        return redirect()->route('admin.dashboard.index');
                        break;
                    default:
                        abort(403);
                        break;
                }
            }
        }
        return $next($request);
    }
}
