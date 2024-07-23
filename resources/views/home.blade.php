<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center">
            <h1>Meu Campeonato</h1>
            <p class="lead">Gerencie seus times e sorteie os resultados.</p>
            <a href="{{ route('times.create') }}" class="btn btn-primary mt-3">Criar Campeonato</a>
        </div>
    </div>
</body>
</html>
