<?php

namespace App\Http\Controllers;

use App\Models\ReadingPlan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function diary(Request $request) 
    {
        $day = date('z') + 1;
        $readingPlanId = $request->readingPlan ?? 1;
        $readingPlan = ReadingPlan::find($readingPlanId);
        $version = $request->version ?? 'acf';

        return view('diary', [
            'selectedVersion' => $version,
            'selectedReadingPlan' => $readingPlan,
            'versions' => [
                'a21' => 'Almeida Século 21',
                'aa' => 'Almeida Atualizada',
                'acf' => 'Almeida Corrigida Fiel',
                'ara' => 'Almeida Revista e Atualizada',
                'arc' => 'Almeida Revista e Corrigida',
                'kja' => 'King James Atualizada',
                'nvi' => 'Nova Versão Internacional',
                'nvt' => 'Nova Versão Transformadora'
            ],
            'readingPlans' => ReadingPlan::all(),
            'day' => $day,
            'chapters' => $readingPlan->getChaptersByDay($day, $version)
        ]);
    }

    public function weekly(Request $request) 
    {
        $readingPlanId = $request->readingPlan ?? 1;
        $readingPlan = ReadingPlan::find($readingPlanId);
        $weekdays = [
            date('z') - date('w') + 1 => 'Domingo',
            date('z') - date('w') + 2 => 'Segunda',
            date('z') - date('w') + 3 => 'Terça',
            date('z') - date('w') + 4 => 'Quarta',
            date('z') - date('w') + 5 => 'Quinta',
            date('z') - date('w') + 6 => 'Sexta',
            date('z') - date('w') + 7 => 'Sábado'
        ];

        return view('weekly', [
            'selectedReadingPlan' => $readingPlan,
            'readingPlans' => ReadingPlan::all(),
            'firstDay' => date('z') - date('w') + 1,
            'lastDay' => date('z') - date('w') + 7,
            'passages' => array_map(fn($weekday, $day) => [
                'weekday' => $weekday,
                'day' => $day,
                'chapters' => $readingPlan->getChaptersByDay($day)
            ], $weekdays, array_keys($weekdays))
        ]);
    }
}
