<?php

namespace App\Http\Middleware\Validations\Relation;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RelationCreation
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
                'relation_name' => ['required', 'unique:ticket_relation,relation_name']
            ],
            [
                'required' => 'The :attribute field is required.',
                'relation_name.unique' => 'The relation name already exists.'
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
