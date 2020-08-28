<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['reference', 'customer_name', 'description', 'email', 'phone', 'agent_viewed_at', 'response'];
}
