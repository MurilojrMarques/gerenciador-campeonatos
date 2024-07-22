<!-- resources/views/times/resultados.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados das Quartas de Final</h1>

        <h2>Confrontos</h2>
        <ul>
            @foreach ($placaresQuartas as $placar)
                <li>{{ $placar['time_casa'] }} {{ $placar['placar_casa'] }} - {{ $placar['placar_visitante'] }} {{ $placar['time_visitante'] }}</li>
            @endforeach
        </ul>

        <h2>Vencedores</h2>
        <ul>
            @foreach ($vencedores as $vencedor)
                <li>{{ $vencedor }}</li>
            @endforeach
        </ul>
    </div>
@endsection
