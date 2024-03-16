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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <script src="https://js.stripe.com/v3/"></script>

</head>
<body
    x-data="{
        hideScroll: false,
    }"
    x-on:lock-scroll="hideScroll = true"
    x-on:unlock-scroll="hideScroll = false"
    :class="hideScroll ? 'font-sans antialiased overflow-hidden bg-brand-blue' : 'font-sans antialiased bg-brand-blue'"
>
<div class="bg-white roboto-regular">
    <x-nav/>
    <x-notification/>

    <main class="mt-16">
        {{ $slot }}
    </main>

    <x-footer/>
</div>

@stack('modals')

@livewireScripts
</body>
</html>
