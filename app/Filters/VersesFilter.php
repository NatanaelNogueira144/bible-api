<?php

namespace App\Filters;

use App\Models\{ Book, Verse };

class VersesFilter 
{
    public function __construct() 
    {}

    public function passagesToQuery(string $version, string $abbrev, string|int $passages) 
    {
        $mainQuery = $this->prepareMainQuery($version, $abbrev);

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

    private function prepareMainQuery(string $version, string $abbrev) {
        return Verse::where([
            ['version', '=', $version],
            ['book_id', '=', Book::where('abbrev', $abbrev)->first()?->id ?? 1]
        ]);
    }
}