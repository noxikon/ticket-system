<?php

namespace App\Http\Middleware\Validations\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserUpdate
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
                'name' => ['required'],
                'email' => ['required', 'unique:user,email'],
                'password' => ['required'],
            ],
            [
                'required' => 'The :attribute field is required.',
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
