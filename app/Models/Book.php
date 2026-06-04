<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'testament_id',
        'name',
        'abbrev'
    ];

    public function testament() 
    {
        return $this->belongsTo(Testament::class);
    }

    public function verses() 
    {
        return $this->hasMany(Verse::class);
    }
}
