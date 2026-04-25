<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mapsily Auth') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Outfit:wght@700&display=swap" rel="stylesheet">

    {{-- Scripts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#85f43a',
                        dark: '#1A1A1A',
                        'dark-lighter': '#242424',
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #1A1A1A; color: #fff; }
        .auth-card { background: #242424; border: 1px solid rgba(255,255,255,0.08); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8">
            <a href="/">
                <img src="/assets/img/Mapsily-wihte-logo.png" alt="Mapsily Logo" class="h-12 w-auto">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 auth-card overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </div>

        <div class="mt-8 text-center">
            <a href="https://mapsily.com" class="text-gray-500 hover:text-brand transition text-sm">← Back to Mapsily.com</a>
        </div>
    </div>
</body>
</html>
