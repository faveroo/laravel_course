<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Laravel + Vue</title>
    @vite('resources/js/app.js')
</head>

<body>
    <style>
        .semaforo {
            width: 120px;
            padding: 15px;
            background: #333;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .luz {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 10px auto;
            background: #555;
        }

        .vermelho {
            background: red;
        }

        .verde {
            background: green;
        }

        .amarelo {
            background: yellow;
        }
    </style>
    <div id="app"></div>
</body>

</html>