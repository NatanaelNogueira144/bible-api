<?php

namespace App\Filters;

use App\Models\{ Book, ReadingPlan, Verse };

class VersesFilter 
{
    public function __construct() 
    {}

    public function passages(string $version, string $abbrev, string|int $passages) 
    {
        $mainQuery = Verse::where([
            ['version', '=', $version],
            ['book_id', '=', Book::where('abbrev', $abbrev)->first()?->id ?? 1]
        ]);

        if(is_string($passages) && (str_contains($passages, ':') || str_contains($passages, ';'))) {
            $mainQuery->where(function($query) use ($passages) {
                $sections = explode(';', $passages);
                foreach($sections as $index => $section) {
                    $sectionParts = explode(':', $section);
                    $chapter = $sectionParts[0];
                    $verses = [];
                    
                    if($sectionParts[1]) {
                        foreach(explode(',', $sectionParts[1]) as $verseChunk) {
                            if(str_contains($verseChunk, '-')) {
                                $parts = explode('-', $verseChunk);
                                $verses = [...$verses, ...range($parts[0], $parts[1])];
                            } else {
                                $verses[] = $verseChunk;
                            }
                        }
                    }

                    if($index == 0) {
                        $query->where(function ($query2) use ($chapter, $verses) {
                            $query2->where('chapter', '=', $chapter)->whereIn('verse', $verses);
                        });
                    } else {
                        $query->orWhere(function ($query2) use ($chapter, $verses) {
                            $query2->where('chapter', '=', $chapter)->whereIn('verse', $verses);
                        });
                    }
                }
            });
        } else {
            $mainQuery->where('chapter', '=', $passages);
        }

        return $mainQuery;
    }

    public function readingPlanDay(int $planId, int $day, string $version) 
    {
        return ReadingPlan::find($planId)->getVersesByDay($day, $version);
    }
}