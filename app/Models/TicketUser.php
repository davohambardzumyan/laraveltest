<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TicketUser extends Pivot
{
    use HasFactory;

    protected $table='ticket_user';

    protected $fillable=[
        'ticket_id',
        'user_id'
    ];
}
