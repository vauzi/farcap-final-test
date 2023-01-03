<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsGuru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = User::query()->where('username', Auth::user()->username)
        if (Auth::user()->role_id !== 2) {
            if ($request->user()->role_id == 1) {
                return redirect(RouteServiceProvider::TU);
            } else {
                return redirect(RouteServiceProvider::SISWA);
            }
        }
        return $next($request);
    }
}
