<!-- resources/views/times/resultados.blade.php -->

@extends('layouts.app')

@section('content')
<div class="bracket">
    <!-- Quartas de Final -->
    <div class="bracket-column">
        <div class="block match-type">
            Quartas de Final
        </div>

        @foreach($placaresQuartas as $match)
        <div class="match">
            <div class="block team">
                {{ $match['time_casa'] }}
                <div class="score">{{ $match['placar_casa'] }}</div>
            </div>
            <div class="block team">
                {{ $match['time_visitante'] }}
                <div class="score">{{ $match['placar_visitante'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Semifinais -->
    <div class="bracket-column">
        <div class="block match-type">
            Semifinal
        </div>

        @foreach($placaresSemifinal as $match)
        <div class="match">
            <div class="block team">
                {{ $match['time_casa'] }}
                <div class="score">{{ $match['placar_casa'] }}</div>
            </div>
            <div class="block team">
                {{ $match['time_visitante'] }}
                <div class="score">{{ $match['placar_visitante'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Finais -->
    <div class="bracket-column">
        <div class="block match-type">
            Final
        </div>

        @foreach($placaresFinal as $match)
        <div class="match">
            <div class="block team">
                {{ $match['time_casa'] }}
                <div class="score">{{ $match['placar_casa'] }}</div>
            </div>
            <div class="block team">
                {{ $match['time_visitante'] }}
                <div class="score">{{ $match['placar_visitante'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
