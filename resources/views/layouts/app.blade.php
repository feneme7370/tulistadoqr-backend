<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
        
        <link rel="icon" type="image/x-icon" href="{{ asset('archives/sistem/img/TuMenuQR_favicon.png') }}">
        <link rel="stylesheet" href="{{asset('lib/lightbox/css/lightbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/toastify/toastify.css')}}">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased transition-all duration-300 ease-in-out dark:bg-gray-300" id="body">

        @include('layouts.includes.sidebarFlowbite')

        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20 ">
            {{ $slot }}
        </main>

    </div>

    @livewireScripts
    <script src="{{asset('lib/flowbite/flowbite.min.js')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox-plus-jquery.min.js')}}"></script>
    <script src="{{asset('lib/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('lib/toastify/toastify.js')}}"></script>
    
    @stack('modals')
    @stack('lightbox')
    @stack('flowbite')
    @stack('scripts')
    
    </body>
</html>