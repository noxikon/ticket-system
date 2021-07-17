<?php

namespace App\Http\Middleware\Validations\Relation;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RelationDelete
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
                'id' => ['required', 'exists:ticket_relation,id']
            ],
            [
                'required' => 'The :attribute field is required.',
                'id.exists' => 'The relation does not exist.'
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
