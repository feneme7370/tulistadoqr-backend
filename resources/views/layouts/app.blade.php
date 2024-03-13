<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="html">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
        
        <link rel="icon" type="image/x-icon" href="{{ asset('archives/sistem/img/TuMenuQR_favicon.png') }}">
        <!-- libs -->
        <link rel="stylesheet" href="{{asset('lib/lightbox/css/lightbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('lib/toastr/toastr.min.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('lib/quill/quill.snow.css')}}"> --}}
        {{-- <script src="{{asset('lib/Summernote/summernote-lite.js')}}"  ></script>
        <link rel="stylesheet" href="{{asset('lib/Summernote/summernote-lite.css')}}"> --}}
        
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        {{-- @livewireStyles --}}


    </head>
    <body class="f-serif antialiased transition-all duration-300 ease-in-out bg-gray-50" id="body">

        @include('layouts.includes.sidebarFlowbite')

        <!-- Page Content -->
        <main class="p-4 sm:ml-64 pt-20 min-h-full mb-20">
            {{ $slot }}
        </main>

    </div>
    {{-- @livewireScripts --}}

    <!-- libs -->
    <script defer src="{{asset('lib/jquery/jquery.min.js')}}"  ></script>
    <script defer src="{{asset('lib/flowbite/flowbite.min.js')}}"  ></script>
    <script defer src="{{asset('lib/lightbox/js/lightbox.min.js')}}"  ></script>
    <script defer src="{{asset('lib/sweetalert2/sweetalert2.all.min.js')}}"  ></script>
    <script defer src="{{asset('lib/toastr/toastr.min.js')}}"  ></script>
    {{-- <script defer src="{{asset('lib/quill/quill.js')}}"  ></script> --}}

    {{-- <script>
        document.addEventListener("livewire:navigated", () => {
            initFlowbite();
        });
    </script> --}}

    @stack('modals')
    @stack('scripts')

    </body>
</html>