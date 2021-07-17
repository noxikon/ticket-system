<?php

namespace App\Http\Middleware\Validations\Ticket;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                'user_id' => [
                    'required',
                    'exists:users,id',
                    Rule::unique('ticket_j_users', 'user_id')->where('ticket_id', $request->get('ticket_id'))
                ]
            ],
            [
                'required' => 'The :attribute field is required.',
                'ticket_id.exists' => 'The ticket does not exist.',
                'user_id.exists' => 'The user does not exist.',
                'user_id.unique' => 'The user is already assigned to the ticket.'
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
