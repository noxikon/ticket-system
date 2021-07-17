<?php

namespace App\Http\Middleware\Validations;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TicketAssignUser
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
                'ticket_id' => ['required', 'exists:ticket,id'],
                'user_id' => ['required', 'exists:users,id'],
            ],
            [
                'required' => 'The :attribute field is required.',
                'ticket_id.exists' => 'The ticket does not exist.',
                'user_id.exists' => 'The user does not exist.'
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
