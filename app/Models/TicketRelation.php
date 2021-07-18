<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketRelation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'ticket_relation';

    protected $fillable = [
        'id', 
        'relation_name'
    ];

    public function __construct(string $name)
    {
        parent::__construct();
        $this->relation_name = $name;
    }
}
