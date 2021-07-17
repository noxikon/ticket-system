<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tickets;
use App\Models\TicketJUser;
use App\Models\TicketConnection;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        $ticket = new Tickets;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->status_id = $request->status_id;
        $ticket->due_date = $request->due_date;
        $ticket->save();

        if(!$ticket){
            return "Error, the ticket can't created.";
        }else{
            return "The ticket has been created!";
        }
    }

    public function update(Request $request)
    {
        $ticket = Tickets::find($request->id);
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->status_id = $request->status_id;
        $ticket->due_date = $request->due_date;
        $ticket->save();

        if(!$ticket){
            return "Error, can't update the ticket.";
        }else{
            return "The ticket has been updatet!";
        }
    }

    public function delete(Request $request)
    {
        $ticket = Tickets::find($request->id);
        $ticket->delete();

        if(!$ticket){
            return "Error, the ticket can't get deletet.";
        }else{
            return "The ticket is deletet.";
        }
    }

    public function changeStatus(Request $request)
    {
        $ticket = Tickets::find($request->ticket_id);
        $ticket->status_id = $request->status_id;
        $ticket->save();

        if(!$ticket){
            return "Error, can't change the status.";
        }else{
            return "The status of the ticket has been changed!";
        }
    }

    public function assignUser(Request $request)
    {
        $ticketJuser = new TicketJUser;
        $ticketJuser->ticket_id = $request->ticket_id;
        $ticketJuser->user_id = $request->user_id;
        $ticketJuser->save();

        if(!$ticketJuser){
            return "Error, the user can't get assign to the ticket.";
        }else{
            return "The ticket is assign to the user.";
        }
    }

    public function unassignUser(Request $request)
    {
        $ticketJuser = TicketJUser::where('ticket_id', $request->get('ticket_id'))
                                    ->where('user_id', $request->get('user_id'))
                                    ->delete();

        if(!$ticketJuser){
            return "Error, the user is still assign to the ticket.";
        }else{
            return "The user is not longer assign to the ticket.";
        }
    }

    public function addTicketRelation(Request $request)
    {
        $ticket_relation = new TicketConnection;
        $ticket_relation->parentticket_id = $request->parentticket_id;
        $ticket_relation->childticket_id = $request->childticket_id;
        $ticket_relation->ticketrelation_id = $request->ticketrelation_id;
        $ticket_relation->save();

        if(!$ticket_relation){
            return "Error, the ticket relation can't created.";
        }else{
            return "The ticket relation has been created!";
        }
    }

    public function removeTicketRelation(Request $request)
    {
        $TicketConnection = TicketConnection::where('parentticket_id', $request->get('parentticket_id'))
                                    ->where('childticket_id', $request->get('childticket_id'))
                                    ->delete();

        if(!$TicketConnection){
            return "Error, the ticket relation can't get delete.";
        }else{
            return "The ticket relation has been deletet!";
        }
    }
}
