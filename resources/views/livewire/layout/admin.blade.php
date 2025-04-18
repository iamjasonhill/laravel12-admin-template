@props(['title' => 'Dashboard'])

<x-layouts.admin :title="$title">
    {{ $slot }}
</x-layouts.admin>
