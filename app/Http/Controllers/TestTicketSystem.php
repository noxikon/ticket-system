<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// model's
use App\Models\Status;
use App\Models\Tickets;

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
/*
        $arr_tickets = [
            [
                "titel" => "System-Service",
                "user_id" => 1,
                "description" => "Sample Text",
                "due_date" => "2020-07-29",
                "status_id" => 1
            ],[
                "titel" => "Ticket 2",
                "description" => "Sample Text",
                "due_date" => "2020-09-30",
                "status_id" => 1
            ], [
                "titel" => "Ticket 3",
                "description" => "Sample Text",
                "due_date" => "2020-12-23",
                "status_id" => 1
            ]
        ];

        foreach($arr_tickets as $tickets){
            $ticket = new Tickets;

            foreach($tickets as $index => $value){
                $ticket->$index = $value;
            }
            $ticket->save();
        }*/

    }
    
}
