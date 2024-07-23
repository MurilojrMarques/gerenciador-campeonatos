<!-- resources/views/times/confrontos.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Confrontos das Quartas de Final</h1>

        <ul>
            @foreach ($confrontos as $confronto)
                <li>{{ $confronto['time_casa'] }} vs {{ $confronto['time_visitante'] }}</li>
            @endforeach
        </ul>
    </div>
@endsection
