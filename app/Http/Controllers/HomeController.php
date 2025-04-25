<?php

namespace App\Http\Controllers;

use App\Models\ReadingPlan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function diary(Request $request) 
    {
        $day = date('z') + 1;
        return view('diary', [
            'selectedVersion' => $request->version ?? 'acf',
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
            'day' => $day,
            'chapters' => ReadingPlan::find(1)->getChaptersByDay($day, $request->version ?? 'acf')
        ]);
    }

    public function weekly(Request $request) 
    {
        $sundayYearNumber = date('z') - date('w') + 1;
        $mondayYearNumber = date('z') - date('w') + 2;
        $tuesdayYearNumber = date('z') - date('w') + 3;
        $wednesdayYearNumber = date('z') - date('w') + 4;
        $thursdayYearNumber = date('z') - date('w') + 5;
        $fridayYearNumber = date('z') - date('w') + 6;
        $saturdayYearNumber = date('z') - date('w') + 7;

        return view('weekly', [
            'firstDay' => $sundayYearNumber,
            'lastDay' => $saturdayYearNumber,
            'passages' => [
                [
                    'weekday' => 'Domingo',
                    'day' => $sundayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($sundayYearNumber)
                ],
                [
                    'weekday' => 'Segunda',
                    'day' => $mondayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($mondayYearNumber)
                ],
                [
                    'weekday' => 'Terça',
                    'day' => $tuesdayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($tuesdayYearNumber)
                ],
                [
                    'weekday' => 'Quarta',
                    'day' => $wednesdayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($wednesdayYearNumber)
                ],
                [
                    'weekday' => 'Quinta',
                    'day' => $thursdayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($thursdayYearNumber)
                ],
                [
                    'weekday' => 'Sexta',
                    'day' => $fridayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($fridayYearNumber)
                ],
                [
                    'weekday' => 'Sábado',
                    'day' => $saturdayYearNumber,
                    'chapters' => ReadingPlan::find(1)->getChaptersByDay($saturdayYearNumber)
                ],
            ]
        ]);
    }
}
