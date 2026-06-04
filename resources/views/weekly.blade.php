<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Semanal</title>
        <style>
            * {
                padding: 0;
                margin: 0;
            }

            body {
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <form style="display: flex; justify-content: center;" id="filters" method="GET" action="#">
            @if($readingPlans)
                <select style="padding: 2px 7px;" name="readingPlan" form="filters">
                    @foreach($readingPlans as $readingPlan)
                        <option value="{{ $readingPlan->id }}" {{ $selectedReadingPlan?->id == $readingPlan->id ? 'selected' : '' }}>
                            {{ $readingPlan->name }}
                        </option>
                    @endforeach
                </select>
            @endif
            <input 
                style="background-color: orange; color: white; cursor: pointer; padding: 2px 7px;" 
                form="filters" 
                type="submit" 
                value="Selecionar" 
            />
        </form>
        <h2 style="font-size: 1.6rem; font-weight: 700;">Leituras da Semana - Dias {{ $firstDay }} à {{ $lastDay }}</h2>
        <h4 style="font-size: 1.3rem; font-weight: 700;">Plano de Leitura: {{ $selectedReadingPlan->name }}</h4>
        <br>
        <table style="border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #CCC">
            <thead>
                <tr style="background-color: orange; color: white">
                    <th style="text-align: left; padding: 4px;">Dia da Semana</th>
                    <th style="text-align: left; padding: 4px;">Passagens</th>
                </tr>
            </thead>
            <tbody>
                @foreach($passages as $index => $passage)
                    <tr style="background-color: <?= $index % 2 == 1 ? 'white' : 'gray; color: white;' ?>">
                        <td style="padding: 4px;"><strong>{{ $passage['weekday'] }} - Dia {{ $passage['day'] }}</strong></td>
                        <td style="padding: 4px;">
                            @if($passage['chapters'])
                                @foreach($passage['chapters'] as $chapter)
                                    <p>
                                        {{ $chapter['book_name'] }} {{ $chapter['chapter'] }} 
                                        {{ $chapter['first_verse'] || $chapter['last_verse'] ? ':' : '' }} 
                                        {{ $chapter['first_verse'] ?? '' }} 
                                        {{ $chapter['first_verse'] || $chapter['last_verse'] ? '-' : '' }} 
                                        {{ $chapter['last_verse'] ?? '' }}
                                    </p>
                                @endforeach
                            @else
                                <p>Nenhuma passagem encontrada</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
