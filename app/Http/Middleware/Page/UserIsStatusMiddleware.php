<?php

namespace App\Http\Middleware\Page;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->user()->status || !auth()->user()->company->status){
            return redirect()->route('user.status')->with('message', 'El usuario esta inhabilitado');
        }
        return $next($request);
    }
}
