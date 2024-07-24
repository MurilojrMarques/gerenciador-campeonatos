<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Times</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Times Cadastrados</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <ul class="list-group mt-3">
            @foreach($times as $time)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $time->nome }}
                    

                    <form action="{{ route('times.delete', $time->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este time?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </li>
            @endforeach
        </ul>


        <div class="mt-4 text-center">
            @if(count($times) < 8)
                <a href="{{ route('times.create') }}" class="btn btn-primary">Cadastrar Novos Times</a>
            @else
                <a href="{{ route('times.sortear-confrontos') }}" class="btn btn-success">Sortear Confrontos</a>
            @endif
        </div>
    </div>
</body>
</html>
