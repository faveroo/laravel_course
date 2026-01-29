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
    <div class="container">
        <div class="microsoft-login-btn">
            <a href="{{ route('auth.microsoft') }}">
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
        <div class="github-login-btn">
            <a href="{{ route('auth.github') }}">
                <span class="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="21"
                        height="21"
                        fill="currentColor"
                        aria-hidden="true">
                        <path d="M12 0.3C5.37 0.3 0 5.67 0 12.3c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.262.82-.582
                0-.288-.01-1.05-.016-2.06-3.338.726-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.757-1.333-1.757
                -1.09-.745.082-.73.082-.73 1.205.085 1.84 1.238 1.84 1.238
                1.07 1.834 2.807 1.304 3.492.997.108-.775.418-1.305.76-1.605
                -2.665-.305-5.466-1.332-5.466-5.93 0-1.31.468-2.38 1.236-3.22
                -.124-.303-.536-1.527.117-3.18 0 0 1.008-.322 3.3 1.23
                .96-.267 1.98-.4 3-.405 1.02.005 2.04.138 3 .405
                2.29-1.552 3.296-1.23 3.296-1.23.655 1.653.243 2.877.12 3.18
                .77.84 1.235 1.91 1.235 3.22 0 4.61-2.807 5.62-5.48 5.92
                .43.372.823 1.102.823 2.222 0 1.606-.014 2.898-.014 3.293
                0 .323.216.7.825.58C20.565 22.092 24 17.592 24 12.3
                24 5.67 18.63 0.3 12 0.3z" />
                    </svg>
                </span>
                <span class="text">Entrar com GitHub</span>
            </a>
        </div>
    </div>

</body>

</html>