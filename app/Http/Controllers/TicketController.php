<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tickets;

class TicketController extends Controller
{
    public function create(Request $request){
        
        $ticket = new Tickets;
        $ticket->titel = $request->title;
        $ticket->userid = $request->userid;
        $ticket->description = $request->description;
        $ticket->status_id = $request->status_id;
        $ticket->due_date = $request->due_date;
        $ticket->save();

        if(!$ticket){
            return "Bitte überprüfen Sie nochmal die Eingabe, das Ticket konnte nicht erstellt werden.";
        }else{
            return "Das Ticket wurde erfolgreich erstellt!";
        }
    }

    public function update(Request $request){
        $ticket = Tickets::find($request->id);
        $ticket->titel = $request->title;
        $ticket->userid = $request->userid;
        $ticket->description = $request->description;
        $ticket->status_id = $request->status_id;
        $ticket->due_date = $request->due_date;
        $ticket->save();

        if(!$ticket){
            return "Bitte überprüfen Sie nochmal die Eingabe, das Ticket konnte nicht erstellt werden.";
        }else{
            return "Das Ticket wurde erfolgreich erstellt!";
        }
    }
}
