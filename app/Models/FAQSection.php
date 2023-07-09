<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQSection extends Model
{
    use HasFactory;
    protected $fillable = ['faq_block_id', 'title', 'content'];

    public function block()
    {
        return $this->belongsTo(FAQBlock::class, 'faq_block_id');
    }
}
