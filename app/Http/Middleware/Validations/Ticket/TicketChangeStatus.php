<?php

namespace App\Http\Middleware\Validations\Ticket;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketChangeStatus
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
                'status_id' => ['required', 'exists:status,id']
            ],
            [
                'required' => 'The :attribute field is required.',
                'status_id.exists' => 'The status does not exist.',
                'ticket_id.exists' => 'The ticket does not exist.'
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
