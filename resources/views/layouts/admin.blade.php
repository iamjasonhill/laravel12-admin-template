<!DOCTYPE html>
<html lang="en" class="h-full antialiased {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Moveroo Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans antialiased">

<div class="min-h-screen flex">
    {{-- Sidebar --}}
    @include('layouts.partials.sidebar')

    <div class="flex-1 flex flex-col">
        {{-- Topbar --}}
        @include('layouts.partials.topbar')

        {{-- Page Content --}}
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>