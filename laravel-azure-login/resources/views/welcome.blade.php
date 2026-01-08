<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
</head>

<body>
    <div><span class="enter-name"><strong>Unimed Avaré</strong></span></div>
    <div class="microsoft-login-btn">
        <a href="#">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21" width="21" height="21">
                    <path fill="#f25022" d="M1 1h9v9H1z" />
                    <path fill="#00a4ef" d="M11 1h9v9h-9z" />
                    <path fill="#7fba00" d="M11 11h9v9h-9z" />
                    <path fill="#ffb900" d="M1 11h9v9H1z" />
                </svg>
            </span>
            <span class="text">Entrar com Microsoft</span>
        </a>
    </div>

</body>

</html>