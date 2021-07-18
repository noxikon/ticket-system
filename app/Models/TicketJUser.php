<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketJUser extends Model
{
    use HasFactory;

    protected $table = 'ticket_j_user';

    protected $fillable = [
        'id', 
        'user_id', 
        'ticket_id', 
        'created_at', 
        'updated_at'
    ];
}
