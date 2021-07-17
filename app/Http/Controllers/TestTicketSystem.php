<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// model's
use App\Models\Status;

class TestTicketSystem extends Controller
{
    public function createStatus(){

        $arr_status = [
            1 => 'todo',
            2 => 'doing',
            3 => 'done',
            4 => 'waiting for response'
        ];

        foreach($arr_status as $status_name){
            $status = new Status;
            $status->status_name = $status_name;
            $status->save();
        }
    }
}
