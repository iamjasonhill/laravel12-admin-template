<!DOCTYPE html>
<html lang="en" class="h-full antialiased {{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Moveroo Admin' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Preload theme to prevent flash of incorrect theme -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
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
{{-- Alpine.js is already included by Livewire, so we don't need to load it again --}}
</body>
</html>
