<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Appointments;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

class DoctorNotify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->is_role==='doctor') {
            $notification = Appointments::where('doctor_id', $user->doctor->id)
            ->where(function ($query) {
                $query->where('notification', 1)
                    ->whereNotIn('is_approve',[3]);
            })
            ->pluck('notification')
            ->count();
            view()->share('notification', $notification);
        } else {
            view()->share('notification',false);
        }

        return $next($request);
    }
}
