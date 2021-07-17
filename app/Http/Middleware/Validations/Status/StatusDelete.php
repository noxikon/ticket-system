<?php

namespace App\Http\Middleware\Validations\Status;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StatusDelete
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
                'id' => ['required', 'exists:status,id', 'unique:ticket,status_id']
            ],
            [
                'id.unique' => 'A ticket has the status.',
                'id.exists' => 'The status does not exist.'
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
