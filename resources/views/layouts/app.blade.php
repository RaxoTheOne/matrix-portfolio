<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Matrix Portfolio') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
        <header class="w-full max-w-7xl mx-auto p-6 flex items-center justify-between">
            <a href="/" class="text-sm font-medium">Matrix Portfolio</a>
            <nav class="hidden lg:flex items-center gap-6 text-sm">
                <a href="#work" class="underline underline-offset-4">Work</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </nav>
        </header>

        <main class="w-full max-w-7xl mx-auto px-6 lg:px-8">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <footer class="w-full max-w-7xl mx-auto p-6 text-sm text-[#706f6c]">
            <p>© {{ date('Y') }} Matrix Portfolio</p>
        </footer>
    </body>
    </html>


