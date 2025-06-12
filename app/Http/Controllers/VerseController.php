<?php

namespace App\Http\Controllers;

use App\Filters\VersesFilter;
use App\Http\Resources\VerseCollection;
use App\Models\{ Book, Verse };
use Illuminate\Support\Facades\Gate;

class VerseController extends Controller
{
    public function index(string $version, string $abbrev, string|int $passages) 
    {
        if(!Gate::allows('view-any-verse')) abort(403);

        $filter = new VersesFilter();
        return new VerseCollection(
            $filter->passagesToQuery($version, $abbrev, $passages)->orderBy('chapter')->orderBy('verse')->with('book')->get()
        );
    }
}
