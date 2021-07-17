<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketRelation extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'ticket_relation';
}
