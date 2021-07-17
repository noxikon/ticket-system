<?php

namespace App\Http\Middleware\Validations\Status;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StatusCreation
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
                'status_name' => ['required', 'unique:status,status_name']
            ],
            [
                'required' => 'The :attribute field is required.',
                'status_name.unique' => 'The status name already exists.'
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
