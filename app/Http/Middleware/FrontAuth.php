<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return string
     */

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()) {
            return $next($request);
        } else {
            if ($request->getPathInfo() == '/checkout'){
                return redirect()->route('front.profile.index', ['register' => 'true', 'checkout' => 'true'])->with('error', 'You don\'t have permission to access this page');
            }
            return redirect()->route('front.profile.index', ['register' => 'true'])->with('error', 'You don\'t have permission to access this page');
        }
    }
}
