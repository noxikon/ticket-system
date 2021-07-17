<?php

namespace App\Http\Middleware\Validations\Ticket;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TicketUpdate
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
                'id' => ['required', 'exists:ticket,id'],
                'title' => ['required'],
                'description' => ['nullable'],
                'due_date' => ['nullable'],
                'status_id' => ['required', 'exists:status,id']
            ],
            [
                'required' => 'The :attribute field is required.',
                'status_id.exists' => 'The status does not exist.',
                'id.exists' => 'The ticket does not exist.'
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
