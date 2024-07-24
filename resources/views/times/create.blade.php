<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Times</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Cadastrar Times</h1>

        <form action="{{ route('times.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="times">Digite os nomes dos 8 times:</label>
                <div class="team-inputs">
                    @for ($i = 1; $i <= 8; $i++)
                        <input type="text" class="form-control" name="times[]" placeholder="Time {{ $i }}" required>
                    @endfor
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Cadastrar Times</button>
        </form>
    </div>
</body>
</html>

