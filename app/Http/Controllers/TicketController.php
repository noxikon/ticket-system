<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Tickets;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $ticket = new Tickets;
        $ticket->title = $request->title;
        $ticket->user_id = $request->user_id;
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

    public function update(Request $request)
    {
        $ticket = Tickets::find($request->id);
        $ticket->title = $request->title;
        $ticket->user_id = $request->user_id;
        $ticket->description = $request->description;
        $ticket->status_id = $request->status_id;
        $ticket->due_date = $request->due_date;
        $ticket->save();

        if(!$ticket){
            return "Bitte überprüfen Sie nochmal die Eingabe, das Ticket konnte nicht geupdatet werden.";
        }else{
            return "Das Ticket wurde erfolgreich geupdatet!";
        }
    }

    public function delete(Request $request)
    {
        $ticket = Tickets::find($request->id);
        $ticket->delete();

        if(!$ticket){
            return "Fehler, das Ticket konnte nicht gelöscht werden.";
        }else{
            return "Das Ticket wurde erfolgreich gelöscht!";
        }
    }

    public function changeStatus(Request $request)
    {
        $ticket = Tickets::find($request->id);
        $ticket->status_id = $request->status_id;
        $ticket->save();

        if(!$ticket){
            return "Fehler, der Status des Tickets konnte nicht geupdatet werden!";
        }else{
            return "Der Status wurde erfolgreich geupdatet!";
        }
    }

    public function assignUser(Request $request)
    {
        $ticket = Tickets::find($request->id);
        $ticket->user_id = $request->user_id;
        $ticket->save();

        if(!$ticket){
            return "Fehler, das Ticket konnte nicht dem User zugewiesen werden!";
        }else{
            return "Das Ticket wurde erfolgreich dem User zugewiesen!";
        }
    }
}
