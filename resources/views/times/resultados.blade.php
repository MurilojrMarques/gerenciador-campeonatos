@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Resultados das Quartas de Final</h1>

        <h2>Confrontos das Quartas de Final</h2>
        <ul>
            @foreach ($placaresQuartas as $placar)
                <li>{{ $placar['time_casa'] }} {{ $placar['placar_casa'] }} - {{ $placar['placar_visitante'] }} {{ $placar['time_visitante'] }}</li>
            @endforeach
        </ul>

        <h2>Vencedores das Quartas de Final</h2>
        <ul>
            @foreach ($vencedoresQuartas as $vencedor)
                <li>{{ $vencedor }}</li>
            @endforeach
        </ul>

        <h2>Confrontos das Semifinais</h2>
        <ul>
            @foreach ($placaresSemifinal as $placar)
                <li>{{ $placar['time_casa'] }} {{ $placar['placar_casa'] }} - {{ $placar['placar_visitante'] }} {{ $placar['time_visitante'] }}</li>
            @endforeach
        </ul>

        <h2>Vencedores das Semifinais</h2>
        <ul>
            @foreach ($vencedoresSemifinal as $vencedor)
                <li>{{ $vencedor }}</li>
            @endforeach
        </ul>

        <h2>Confronto Final</h2>
        <ul>
            @foreach ($placaresFinal as $placar)
                <li>{{ $placar['time_casa'] }} {{ $placar['placar_casa'] }} - {{ $placar['placar_visitante'] }} {{ $placar['time_visitante'] }}</li>
            @endforeach
        </ul>

        <h2>Vencedor Final</h2>
        <p>{{ $vencedorFinal }}</p>
    </div>
@endsection
