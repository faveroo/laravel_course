<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-gray-800">
    <div class="container mx-auto mt-5">
        <div class="flex flex-wrap justify-center">
            <div class="w-1/2 px-2">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>