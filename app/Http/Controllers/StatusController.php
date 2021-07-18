<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Status;

class StatusController extends Controller
{
    public function create(Request $request)
    {
        $status = Status::create([
            'status_name' => $request->status_name
        ]);
        $status->save();

        if(!$status){
            return "Error, the status can't created.";
        }else{
            return "The status has been created!";
        }
    }

    public function delete(Request $request)
    {
        $status = Status::find($request->id);
        $status->delete();

        if(!$status){
            return "Error, the status can't get deletet.";
        }else{
            return "The status is deletet.";
        }
    }

    public function all(Request $request)
    {
        $status = Status::all();

        if(!$status){
            return "Error, something went wrong.";
        }else{
            return $status;
        }
    }
}
