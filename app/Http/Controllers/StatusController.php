<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// modal's
use App\Models\Tickets;
use App\Models\Status;

class StatusController extends Controller
{
    public function create(Request $request)
    {
        $status = new Status;
        $status->status_name = $request->status_name;
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

    public function getStatus(Request $request)
    {
        $status = Status::all();

        if(!$status){
            return "Error, something went wrong.";
        }else{
            return $status;
        }
    }
}
