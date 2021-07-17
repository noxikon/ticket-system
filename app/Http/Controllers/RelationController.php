<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketRelation;

class RelationController extends Controller
{
    public function create(Request $request)
    {
        $relation = new TicketRelation(
            $request->relation_name
        );
        $relation->save();

        if(!$relation){
            return "Error, the relation can't created.";
        }else{
            return "The relation has been created!";
        }
    }

    public function delete(Request $request)
    {
        $relation = TicketRelation::find($request->id);
        $relation->delete();

        if(!$relation){
            return "Error, the relation can't get deletet.";
        }else{
            return "The relation is deletet.";
        }
    }

    public function all(Request $request)
    {
        $relation = TicketRelation::all();

        if(!$relation){
            return "Error, something went wrong.";
        }else{
            return $relation;
        }
    }
}
