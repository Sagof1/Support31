<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQBlock extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description'];

    public function sections()
    {
        return $this->hasMany(FAQSection::class, 'faq_block_id');
    }
}
