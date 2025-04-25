<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingPlan extends Model
{
    protected $fillable = [
        'name'
    ];

    public function readingPlanDays() 
    {
        return $this->hasMany(ReadingPlanDay::class);
    }

    public function verses() 
    {
        return $this->hasMany(Verse::class);
    }

    public function getChaptersByDay(int $day, string $version = 'acf') 
    {
        if($readingPlanDays = $this->readingPlanDays()->with(['book'])->where('day', $day)->get()) {
            $passages = array_map(fn($readingPlanDay) => [
                'book_id' => $readingPlanDay['book_id'],
                'book_name' => $readingPlanDay['book']['name'],
                'chapter' => $readingPlanDay['chapter'],
                'first_verse' => $readingPlanDay['first_verse'],
                'last_verse' => $readingPlanDay['last_verse']
            ], $readingPlanDays->toArray());

            if($passages) {
                $verses = Verse::where(function($query1) use ($passages) {
                    foreach($passages as $passage) {
                        $query1->orWhere(function($query2) use ($passage) {
                            $query2->where('book_id', $passage['book_id']);
                            $query2->where('chapter', $passage['chapter']);
                            if($passage['first_verse']) $query2->where('verse', '>=', $passage['first_verse']);
                            if($passage['last_verse']) $query2->where('verse', '<=', $passage['last_verse']);
                        });
                    }
                });

                $verses = $verses->where('version', $version)
                    ->orderBy('book_id', 'ASC')
                    ->orderBy('chapter', 'ASC')
                    ->orderBy('verse', 'ASC')
                    ->get();
                
                return (function($passages, $verses) {
                    $chapters = [];
                    foreach($passages as $passage) {
                        $chapters[$passage['chapter']] = $passage + [
                            'verses' => []
                        ];
                    }

                    foreach($verses as $verse) {
                        $chapters[$verse->chapter]['verses'][] = $verse;
                    }

                    return array_map(fn($chapter) => $chapter, $chapters);
                })($passages, $verses);
            }
        }

        return null;
    }
}
