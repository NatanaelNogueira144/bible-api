<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    protected $fillable = [
        'testament_id',
        'book_id',
        'version',
        'chapter',
        'verse',
        'text'
    ];

    public function testament() 
    {
        return $this->belongsTo(Testament::class);
    }

    public function book() 
    {
        return $this->belongsTo(Book::class);
    }
}
