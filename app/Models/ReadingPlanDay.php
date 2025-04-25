<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingPlanDay extends Model
{
    protected $fillable = [
        'reading_plan_id',
        'day',
        'book_id',
        'chapter',
        'first_verse',
        'last_verse'
    ];

    public function readingPlan() 
    {
        return $this->belongsTo(ReadingPlan::class);
    }

    public function book() 
    {
        return $this->belongsTo(Book::class);
    }
}
