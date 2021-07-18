<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketConnection extends Model
{
    use HasFactory;

    protected $table = 'ticket_connection';

    protected $fillable = [
        'id', 
        'parentticket_id', 
        'childticket_id', 
        'ticketrelation_id', 
        'created_at', 
        'updated_at'
    ];
}
