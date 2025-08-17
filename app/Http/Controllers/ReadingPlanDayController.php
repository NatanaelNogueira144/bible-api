<?php

namespace App\Http\Controllers;

use App\Filters\VersesFilter;
use App\Http\Resources\VerseCollection;
use Illuminate\Support\Facades\Gate;

class ReadingPlanDayController extends Controller
{
    public function index(int $planId, int $day, string $version) 
    {
        if(!Gate::allows('view-any-reading-plan-day')) abort(403);

        $filter = new VersesFilter();
        return new VerseCollection($filter->readingPlanDay($planId, $day, $version));
    }
}
