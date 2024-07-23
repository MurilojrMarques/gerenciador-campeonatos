<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chaveamento</title>
    <!-- Link para o Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .bracket {
            font-family: 'Roboto', sans-serif; /* Aplica a fonte Roboto */
            font-size: 11px;
            border: 2px solid black;
        }

        .bracket-column {
            max-width: 180px;
            vertical-align: middle;
            display: inline-block;
        }

        .match {
            margin-bottom: 20px;
        }

        .block {
            border: 1px solid #aaa;
            border-radius: 2px;
            padding: 2px 0;
            position: relative;
            background: #ebebeb;
            line-height: 18px;
            padding-right: 23px;
        }

        .team {
            padding-right: 23px;
        }

        .match-type {
            text-align: center;
            margin-bottom: 20px;
        }

        .score {
            width: 21px;
            text-align: center;
            border-left: 1px solid #aaa;
            line-height: 24px;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
        }

        .connectors {
            position: relative;
            vertical-align: middle;
            display: inline-block;
            padding-top: 30px;
            left: -4px;
        }

        .next {
            display: inline-block;
        }

        .leftdown, .leftup, .downright, .upright {
            position: relative;
            border-color: #aaa;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
