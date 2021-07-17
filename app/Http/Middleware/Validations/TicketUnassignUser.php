<?php

namespace App\Http\Middleware\Validations;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketUnassignUser
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
                'ticket_id' => ['required'],
                'user_id' => [
                    'required',
                    Rule::exists('ticket_j_users', 'user_id')->where('ticket_id', $request->get('ticket_id'))
                ]
            ],
            [
                'required' => 'The :attribute field is required.',
                'user_id.exists' => 'The user is not assigned to the ticket.'
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
