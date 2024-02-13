<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
        
        <link rel="icon" type="image/x-icon" href="{{ asset('archives/sistem/img/TuMenuQR_favicon.png') }}">
        <link rel="stylesheet" href="{{asset('lib/lightbox/css/lightbox.min.css')}}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])



        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased transition-all duration-300 ease-in-out" id="body">

        @include('layouts.includes.sidebarFlowbite')

        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20">
            {{ $slot }}
        </main>

    </div>

    @livewireScripts
    <script src="{{asset('lib/flowbite/flowbite.min.js')}}"></script>
    <script src="{{asset('lib/dist/js/lightbox-plus-jquery.min.js')}}"></script>
    
    @stack('modals')
    @stack('lightbox')
    
    </body>
</html>
