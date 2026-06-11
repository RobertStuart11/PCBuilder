<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PCBuilder') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-100 antialiased bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Effects -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10">
                <div class="mb-8 flex justify-center">
                    <a href="/" class="text-center hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logo.png') }}" alt="PCBuilder Logo" class="h-16 mx-auto mb-2">
                        <p class="text-xs text-gray-400">Build Your Dream PC</p>
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-gradient-to-b from-slate-800/50 to-slate-900/50 backdrop-blur-xl border border-slate-700/50 shadow-2xl overflow-hidden sm:rounded-2xl hover:border-slate-600/50 transition-colors">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
