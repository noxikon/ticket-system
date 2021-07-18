<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('authorization') !== 'ticket d41d8cd98f00b204e9800998ecf8427e') {
            //return redirect('welcome');
            return new Response('The authentication toke is wrong or not set!');
        }

        return $next($request);
    }
}
