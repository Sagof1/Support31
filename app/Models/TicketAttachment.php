<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TicketAttachment extends Model
{
    use HasFactory;

    public function ticket()
{
    return $this->belongsTo(Ticket::class);
}

public function comment()
{
    return $this->belongsTo(Comment::class);
}

}
