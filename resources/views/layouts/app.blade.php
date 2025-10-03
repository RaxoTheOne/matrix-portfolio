<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Matrix Portfolio') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-black text-[#00ff7f] min-h-screen font-mono">
        <canvas id="matrixRain" class="fixed inset-0 -z-10"></canvas>
        <div class="fixed inset-0 -z-10 bg-black/75"></div>

        <header class="w-full max-w-6xl mx-auto p-4 lg:p-6 flex items-center justify-between">
            <a href="/" class="text-sm font-medium tracking-wide">&lt;/&gt; RaxoTheOne</a>
            <nav class="hidden lg:flex items-center gap-6 text-sm">
                <a href="#about" class="hover:underline underline-offset-4">About</a>
                <a href="#projects" class="hover:underline underline-offset-4">Projects</a>
                <a href="#contact" class="hover:underline underline-offset-4">Contact</a>
                <a href="https://github.com/" target="_blank" class="px-3 py-1 border border-[#00ff7f66] rounded-sm hover:bg-[#00ff7f] hover:text-black transition">GitHub</a>
            </nav>
        </header>

        <main class="w-full max-w-6xl mx-auto px-4 lg:px-6">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <footer class="w-full max-w-6xl mx-auto p-6 text-xs text-[#7ee7b5]">
            <p>© {{ date('Y') }} Matrix Portfolio · Built with Laravel</p>
        </footer>
    </body>
    </html>


