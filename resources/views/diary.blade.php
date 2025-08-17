<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Diário</title>
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
            @if($versions)
                <select style="padding: 2px 7px;" name="version" form="filters">
                    @foreach($versions as $versionAbbrev => $versionName)
                        <option value="{{ $versionAbbrev }}" {{ $selectedVersion == $versionAbbrev ? 'selected' : '' }}>
                            {{ $versionName }}
                        </option>
                    @endforeach
                </select>
            @endif
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
        <h2 style="font-size: 1.6rem; font-weight: 700;">Leitura de Hoje - Dia {{ $day }}</h2>
        <h4 style="font-size: 1.3rem; font-weight: 700;">Plano de Leitura: {{ $selectedReadingPlan->name }}</h4>
        <h4 style="font-size: 1.3rem; font-weight: 700;">Versão Atual: {{ $versions[$selectedVersion] }}</h4>
        <br>
        @if($chapters)
            @foreach($chapters as $chapter)
                <h4 style="font-size: 1.3rem; font-weight: 700;">
                    {{ $chapter['book_name'] }} {{ $chapter['chapter'] }} {{ $chapter['first_verse'] || $chapter['last_verse'] ? ':' : '' }} 
                    {{ $chapter['first_verse'] ?? '' }} 
                    {{ $chapter['first_verse'] || $chapter['last_verse'] ? '-' : '' }} 
                    {{ $chapter['last_verse'] ?? '' }}
                </h4>
                @foreach($chapter['verses'] as $verse)
                    <p><strong>{{ $verse->verse }}.</strong> {{ $verse->text }}</p>
                @endforeach
                <br>
            @endforeach
        @endif
    </body>
</html>
