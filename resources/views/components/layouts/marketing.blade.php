<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body
    x-data="{
        hideScroll: false,
    }"
    x-on:lock-scroll="hideScroll = true"
    x-on:unlock-scroll="hideScroll = false"
    :class="hideScroll ? 'font-sans antialiased overflow-hidden' : 'font-sans antialiased'"
>
<div class="bg-white">
    <x-nav/>
    <x-notification/>

    <main>
        {{ $slot }}
    </main>

    <x-footer/>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
