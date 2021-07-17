<?php

namespace App\Http\Middleware\Validations\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserDelete
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => ['required', 'exists:user,id'],
            ],
            [
                'id.exists' => 'The user does not exist.'
            ]
        );

        if ($validator->fails()) {
            return new Response(
                $validator->errors()->first()
            );
        }

        return $next($request);
    }
}
