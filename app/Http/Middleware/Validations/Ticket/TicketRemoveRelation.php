<?php

namespace App\Http\Middleware\Validations\Ticket;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TicketRemoveRelation
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
                'parentticket_id' => [
                    'required',
                    'exists:ticket,id',
                    Rule::exists('ticket_connection', 'parentticket_id')->where('childticket_id', $request->get('childticket_id'))
                ],
                'childticket_id' => [
                    'required',
                    'exists:ticket,id'
                ]
            ],
            [
                'required' => 'The :attribute field is required.',
                'ticketrelation_id.exists' => 'The relation does not exist.'
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
