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
                'id' => ['required', 'exists:user,id', 'unique:ticket_j_user,user_id'],
            ],
            [
                'required' => 'The :attribute field is required.',
                'id.exists' => 'The user does not exist.',
                'id.unique' => 'The user is assign to a ticket.',
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
