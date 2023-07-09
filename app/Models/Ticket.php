<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'description',
        'status',
        'user_id',
        'support_agent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportAgent()
    {
        return $this->belongsTo(User::class, 'support_agent_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
