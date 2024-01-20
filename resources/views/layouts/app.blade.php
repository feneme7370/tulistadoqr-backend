<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        @include('layouts.includes.sidebarFlowtrail')

        <div class="w-full">
            <div class="max-w-7xl mx-auto p-1 sm:px-6 lg:px-8">
                <div class="bg-white mt-2 sm:mt-8 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="sm:p-6 lg:p-8 bg-white border-b border-t border-gray-200">

                        <!-- Page Content -->
                        <main>
                            {{ $slot }}
                        </main>
                    </div>
                </div>
                @include('layouts.includes.footer-basic')
            </div>
        </div>

    </div>



    @stack('modals')
    
    @livewireScripts
    {{-- <script src="{{asset('public/lib/windmill/js/focus-trap.js')}}"></script>
    <script src="{{asset('public/lib/windmill/js/init-alpine.js')}}"></script> --}}
    </body>
</html>
