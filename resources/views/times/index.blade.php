@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Times</h1>

        <ul>
            @foreach ($times as $time)
                <li>{{ $time->nome }}</li>
            @endforeach
        </ul>
    </div>
@endsection
