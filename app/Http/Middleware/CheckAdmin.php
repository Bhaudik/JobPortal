<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() != null) {
            if ($request->user()->role == 'admin') {
                return $next($request);
            }
        }
        session()->flash('error', 'you are not authorized to access this page');
        return redirect()->route('account.profile');
    }
}
