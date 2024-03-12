<x-guest-layout>
<body class="overflow-x-hidden antialiased scroll-smooth">

    <!-- HEADER SECTION -->
    <header class="relative z-50 w-full h-24">
        <div
            class="container flex items-center justify-center h-full max-w-6xl px-8 mx-auto sm:justify-between xl:px-0 ">

            {{-- logo --}}
            <a href="/" class="relative flex items-center h-5 font-black leading-none">
                <img class="h-8 w-8 object-cover" src="{{asset($company->image_logo_uri.$company->image_logo)}}" alt="">
                <span class="ml-3 text-xl text-gray-800">{{$company->name}}<span class="text-pink-500">.</span></span>
            </a>

            {{-- navbar --}}
            <nav id="nav"
                class="absolute top-0 left-0 z-80 flex flex-col items-center justify-between hidden w-full h-64 pt-5 mt-24 text-sm text-gray-800 bg-white md:w-auto md:flex-row md:h-24 lg:text-base md:bg-transparent md:mt-0 md:border-none md:py-0 md:flex md:relative">
                <a href="#"
                    class="ml-0 mr-0 font-bold duration-100 md:ml-12 md:mr-3 lg:mr-8 transition-color hover:text-primary-600">Inicio</a>
                <a href="#features"
                    class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-primary-600">Servicio</a>
                <a href="#demos"
                    class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-primary-600">Demos</a>
                <a href="#pricing"
                    class="mr-0 font-bold duration-100 md:mr-3 lg:mr-8 transition-color hover:text-primary-600">Membresias</a>

                <div class="flex flex-col w-full font-medium md:hidden">
                    <a href="{{route('login')}}" class="w-full text-lg py-2 font-bold text-center text-primary-800 hover:text-primary-600">Acceso</a>
                    <a href="https://api.whatsapp.com/send/?phone=5492396513953&amp;text=Quier saber mas sobre TuMenuQR" target="_blank"
                        class="relative inline-block w-full px-5 py-3 text-sm leading-none text-center text-gray-100 bg-primary-900 fold-bold">Contactame</a>
                </div>
            </nav>

            {{-- navbar boton login y contactame responsive --}}
            <div
                class="absolute z-80 left-0 flex-col items-center justify-center hidden w-full pb-8 mt-48 md:relative md:w-auto md:bg-transparent md:border-none md:mt-0 md:flex-row md:p-0 md:items-end md:flex md:justify-between">
                <a href="{{route('login')}}"
                    class="relative z-40 px-3 py-2 mr-0 text-base font-bold text-primary-800 hover:text-primary-600 md:px-5 sm:mr-3 md:mt-0">Acceso</a>
                <a href="https://api.whatsapp.com/send/?phone=5492396513953&amp;text=Quier saber mas sobre TuMenuQR" target="_blank"
                    class="relative z-40 inline-block w-auto h-full px-5 py-3 text-sm font-bold leading-none text-gray-100 transition-all duration-300 bg-primary-900 rounded shadow-md fold-bold sm:w-full lg:shadow-none">Contactame</a>

                {{-- parte azul y rosa --}}
                {{-- <svg class="absolute top-0 left-0 hidden w-screen max-w-3xl -mt-64 -ml-12 lg:block"
                    viewBox="0 0 818 815" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <linearGradient x1="0%" y1="0%" x2="100%" y2="100%" id="c">
                            <stop stop-color="#E614F2" offset="0%" />
                            <stop stop-color="#FC3832" offset="100%" />
                        </linearGradient>
                        <linearGradient x1="0%" y1="0%" x2="100%" y2="100%" id="f">
                            <stop stop-color="#657DE9" offset="0%" />
                            <stop stop-color="#1C0FD7" offset="100%" />
                        </linearGradient>
                        <filter x="-4.7%" y="-3.3%" width="109.3%" height="109.3%" filterUnits="objectBoundingBox"
                            id="a">
                            <feOffset dy="8" in="SourceAlpha" result="shadowOffsetOuter1" />
                            <feGaussianBlur stdDeviation="8" in="shadowOffsetOuter1" result="shadowBlurOuter1" />
                            <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0" in="shadowBlurOuter1" />
                        </filter>
                        <filter x="-4.7%" y="-3.3%" width="109.3%" height="109.3%" filterUnits="objectBoundingBox"
                            id="d">
                            <feOffset dy="8" in="SourceAlpha" result="shadowOffsetOuter1" />
                            <feGaussianBlur stdDeviation="8" in="shadowOffsetOuter1" result="shadowBlurOuter1" />
                            <feColorMatrix values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0" in="shadowBlurOuter1" />
                        </filter>
                        <path
                            d="M160.52 108.243h497.445c17.83 0 24.296 1.856 30.814 5.342 6.519 3.486 11.635 8.602 15.12 15.12 3.487 6.52 5.344 12.985 5.344 30.815v497.445c0 17.83-1.857 24.296-5.343 30.814-3.486 6.519-8.602 11.635-15.12 15.12-6.52 3.487-12.985 5.344-30.815 5.344H160.52c-17.83 0-24.296-1.857-30.814-5.343-6.519-3.486-11.635-8.602-15.12-15.12-3.487-6.52-5.343-12.985-5.343-30.815V159.52c0-17.83 1.856-24.296 5.342-30.814 3.486-6.519 8.602-11.635 15.12-15.12 6.52-3.487 12.985-5.343 30.815-5.343z"
                            id="b" />
                        <path
                            d="M159.107 107.829H656.55c17.83 0 24.296 1.856 30.815 5.342 6.518 3.487 11.634 8.602 15.12 15.12 3.486 6.52 5.343 12.985 5.343 30.816V656.55c0 17.83-1.857 24.296-5.343 30.815-3.486 6.518-8.602 11.634-15.12 15.12-6.519 3.486-12.985 5.343-30.815 5.343H159.107c-17.83 0-24.297-1.857-30.815-5.343-6.519-3.486-11.634-8.602-15.12-15.12-3.487-6.519-5.343-12.985-5.343-30.815V159.107c0-17.83 1.856-24.297 5.342-30.815 3.487-6.519 8.602-11.634 15.12-15.12 6.52-3.487 12.985-5.343 30.816-5.343z"
                            id="e" />
                    </defs>
                    <g fill="none" fill-rule="evenodd" opacity=".9">
                        <g transform="rotate(65 416.452 409.167)">
                            <use fill="#000" filter="url(#a)" xlink:href="#b" />
                            <use fill="url(#c)" xlink:href="#b" />
                        </g>
                        <g transform="rotate(29 421.929 414.496)">
                            <use fill="#000" filter="url(#d)" xlink:href="#e" />
                            <use fill="url(#f)" xlink:href="#e" />
                        </g>
                    </g>
                </svg> --}}
            </div>

            {{-- boton hamburguesa --}}
            <div id="nav-mobile-btn"
                class="absolute top-0 right-0 z-80 block w-6 mt-8 mr-10 cursor-pointer select-none md:hidden sm:mt-10">
                <span class="block w-full h-1 mt-2 duration-200 transform bg-primary-700 rounded-full sm:mt-1"></span>
                <span class="block w-full h-1 mt-1 duration-200 transform bg-primary-700 rounded-full"></span>
            </div>

        </div>
    </header>
    <!-- HEADER SECTION END -->

    <!-- HERO SECTION -->
    <div class="relative items-center justify-center w-full overflow-x-hidden lg:pt-20 lg:pb-20 xl:pt-20 xl:pb-64">
        <div
            class="container flex flex-col items-center justify-between gap-5 h-full max-w-6xl px-8 mx-auto -mt-32 lg:flex-row xl:px-0">
            <div
                class="z-30 sm:flex flex-col items-center w-full hidden max-w-xl pt-40 text-center lg:items-start lg:w-1/2 lg:pt-20 xl:pt-40 lg:text-left">
                <h1 class="relative mb-4 text-3xl font-black leading-tight text-gray-900 sm:text-6xl xl:mb-8">Solicita tu menu digital</h1>
                <p class="pr-0 mb-8 text-base text-gray-600 sm:text-lg xl:text-xl lg:pr-20">{{$company->description}}</p>
                {{-- <a href="{{route('register')}}"
                    class="relative self-start inline-block w-auto px-8 py-4 mx-auto mt-0 text-base font-bold text-white bg-indigo-600  rounded-md shadow-xl sm:mt-1 fold-bold lg:mx-0">Registrarme</a> --}}

                {{-- seccion de redes sociales propias --}}
                <div class="flex-col hidden mt-3 sm:mt-12 sm:flex lg:mt-24">
                    <p class="mb-4 text-sm font-medium tracking-widest text-gray-500 uppercase">Redes sociales</p>
                    <div class="flex items-center gap-3">
                        @foreach ($company->socialMedia as $item)
                            
                            <a href="https://{{$item->pivot->url}}" target="_blank" >
                                <x-sistem.icons.for-icons-social :icon="$item->slug" />
                            </a>
                            
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- imagen de pc derecha --}}
            <div class="relative z-10 flex flex-col items-end justify-center w-full h-full lg:w-1/2 ms:pl-10 mt-40 mb-5">
                <div class="container relative left-0 w-full max-w-4xl lg:absolute xl:max-w-6xl lg:w-screen">
                    <img src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/226962964/original/55e325403da145a8a5cb816db41ee2a8bed41f3f/design-professional-creative-digital-food-menu-restaurant-menu-card-cafe-menu.png"
                        class="w-full rounded-xl h-auto  ml-0 lg:mt-24 xl:mt-40 lg:mb-0 lg:h-full lg:-ml-12">
                    {{-- <img src="https://cdn.devdojo.com/images/september2020/macbook-mockup.png"
                        class="w-full h-auto mt-20 mb-20 ml-0 lg:mt-24 xl:mt-40 lg:mb-0 lg:h-full lg:-ml-12"> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- HERO SECTION END -->

    <!-- FEATURES SECTION -->
    <div id="features" class="relative w-full px-8 py-2 md:py-8 lg:py-16 xl:py-24 xl:px-0">
        <div class="container flex flex-col items-center justify-between h-full max-w-6xl mx-auto">
            
            <h2 class="mt-5 mb-10 text-base font-medium tracking-tight text-primary-500 uppercase">Nuestros servicios</h2>
            <hr class="border border-primary-900 w-full">
            
            {{-- titulo de nuestros servicios --}}
            <h3
                class="max-w-2xl px-5 mt-2 text-3xl font-black leading-tight text-center text-gray-900 sm:mt-0 sm:px-0 sm:text-6xl">
                Ofrecemos todo para que puedas gestionar tu menu</h3>

            <div class="flex flex-col sm:flex-row items-center mt-5 gap-5 w-full lg:flex-row sm:mt-10 lg:mt-20">

            @foreach ($services as $service)
                
            <a href="#" class="w-full max-w-sm p-2 flex justify-center items-center flex-col">
                <span class="h-16 w-16 fill-primary-800 mb-5"><x-sistem.icons.for-icons-home :icon="$service['icon']" /> </span>
                <h5 class="mb-2 text-lg text-center font-bold tracking-tight text-gray-900">{{ $service['title'] }}</h5>
                <p class="font-sm italic text-gray-700">{{ $service['description'] }}</p>
            </a>

            @endforeach
    
           </div>
        </div>
    </div>
    <!-- FEATURES SECTION END -->
    
    <!-- PICTURE SECTION -->
    <div id="pictures" class="relative w-full px-8 py-2 md:py-8 lg:py-16 xl:py-24 xl:px-0">
        <div class="container flex flex-col items-center justify-between h-full max-w-6xl mx-auto">
            <h2 class="mt-5 mb-10 text-base font-medium tracking-tight text-primary-500 uppercase">Imagenes</h2>
            <hr class="border border-primary-900 w-full mb-5">
            <div class="w-full my-4 flex flex-col items-center gap-3 justify-around sm:flex-row">



                <div class="grid md:grid-cols-2 gap-2">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ asset('archives/sistem/img/social (2).png') }}" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ asset('archives/sistem/img/social (1).png') }}" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ asset('archives/sistem/img/social (3).png') }}" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ asset('archives/sistem/img/social (5).png') }}" alt="">
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- PICTURE SECTION END -->

    <!-- DEMO SECTION -->
    <div id="demos" class="relative w-full px-8 py-2 md:py-8 lg:py-16 xl:py-24 xl:px-0">
        <div class="container flex flex-col items-center justify-between h-full max-w-6xl mx-auto">
            <h2 class="mt-5 mb-10 text-base font-medium tracking-tight text-primary-500 uppercase">Mira nuestras demos</h2>
            <hr class="border border-primary-900 w-full mb-5">
            <div class="w-full my-4 flex flex-col items-center gap-3 justify-around sm:flex-row">

                <div class="w-full md:w-auto flex flex-col items-center bg-gray-50 border border-gray-200 rounded-lg shadow md:max-w-xl hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-80 md:h-auto md:w-56 md:rounded-none md:rounded-s-lg" lazy="loading" src="{{ asset('archives/sistem/img/demo1.jpg') }}" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Meriendalunas</h5>
                        <p class="mb-3 font-normal text-gray-700">Menu para merendar.</p>
                        <a href="https://tulistadoqr-demo1.femaser.com/" target="_blank"
                        class="relative inline-block w-full p-2 text-sm rounded-2xl text-center text-gray-100 bg-primary-900 hover:bg-primary-700 fold-bold">Demo 1</a>
                    </div>
                </div>
                <div class="w-full md:w-auto flex flex-col items-center bg-gray-50 border border-gray-200 rounded-lg shadow md:max-w-xl hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-80 md:h-auto md:w-56 md:rounded-none md:rounded-s-lg" lazy="loading" src="{{ asset('archives/sistem/img/demo2.jpg') }}" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">El Favorito</h5>
                        <p class="mb-3 font-normal text-gray-700">Rotiseria.</p>
                        <a href="https://tulistadoqr-demo2.femaser.com/" target="_blank"
                        class="relative inline-block w-full p-2 text-sm rounded-2xl text-center text-gray-100 bg-primary-900 hover:bg-primary-700 fold-bold">Demo 2</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- DEMO SECTION END -->

    <!-- PRICING SECTION -->
    <div class="relative px-8 py-10 bg-white md:py-16 lg:py-24 xl:py-40 xl:px-0">

        <div id="pricing" class="container flex flex-col items-center h-full max-w-6xl mx-auto">
            <h2 class="mt-5 mb-10 text-base font-medium tracking-tight text-primary-500 uppercase">Nuestros precios</h2>
            <hr class="border border-primary-900 w-full">
            <h3
                class="w-full max-w-2xl px-8 mt-2 text-2xl font-black leading-tight text-center text-gray-900 sm:mt-0 sm:px-0 sm:text-6xl md:px-0">
                Simple, util y al acceso de todos</h3>

            <div class="max-w-full mx-auto md:max-w-6xl sm:px-8">
                <div class="relative flex flex-col items-center sm:flex-row">

                    <!-- Pro Pricing -->
                    @foreach ($memberships as $membership)
                        
                    
                    <div
                        class="relative z-10 w-full max-w-md my-8 bg-white rounded-lg shadow-lg sm:w-2/3 lg:w-1/3 sm:my-5">
                        @if ( $membership->id == 2 )
                        <div
                            class="py-4 text-sm font-semibold leading-none tracking-wide text-center text-white uppercase bg-primary-500 rounded-t">
                            Mas adquirido
                        </div>
                        @endif
                        <div class="block max-w-sm px-8 mx-auto mt-5 text-sm text-left text-black sm:text-md lg:px-6">
                            <h3 class="p-3 pb-1 text-lg font-bold tracking-wide text-center uppercase">{{$membership->short_description}}</h3>
                            <h4
                                class="flex items-center justify-center pb-6 text-5xl font-bold text-center text-gray-900">
                                <span class="mr-1 -ml-2 text-lg text-gray-700">$</span>{{number_format($membership->price, 0,",",".")}}</h4>
                            <p class="text-sm text-gray-600 text-center">{{$membership->description}}</p>
                        </div>
                        <div class="flex justify-start pl-12 mt-8 sm:justify-start">
                            <ul>
                                <li class="flex items-center">
                                    <div class="p-2 text-primary-500 rounded-full fill-current">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-1 text-sm text-gray-700">{{$membership->category}} Categorias</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-primary-500 rounded-full fill-current ">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-1 text-sm text-gray-700">{{$membership->product}} Productos</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-primary-500 rounded-full fill-current ">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-1 text-sm text-gray-700">{{$membership->tag}} Etiquetas</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-primary-500 rounded-full fill-current ">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-1 text-sm text-gray-700">{{$membership->suggestion}} Destacados</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="p-2 text-primary-500 rounded-full fill-current ">
                                        <svg class="w-6 h-6 align-middle" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="ml-1 text-sm text-gray-700">{{$membership->list_product ? 'Podes armar el pedido' : 'Sin menu para armar pedido'}}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="flex items-center p-8 uppercase">
                            <a href="https://api.whatsapp.com/send/?phone=5492396513953&amp;text=Quier saber mas sobre TuListadoQR, el plan {{ $membership->short_description }} de {{ $membership->price }}" target="_blank"
                                class="block w-full px-2 py-3 mt-3 text-base font-semibold text-center text-white bg-gray-900 rounded shadow-sm hover:bg-primary-600">Lo quiero!</a>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- PRICING SECTION END -->

    <!-- TESTIMONIALS -->
    {{-- <div id="testimonials"
        class="flex items-center justify-center w-full px-8 py-10 md:py-16 lg:py-24 xl:py-40 xl:px-0">
        <div class="max-w-6xl mx-auto">
            <div class="flex-col items-center ">
                <div class="flex flex-col items-center justify-center w-full h-full max-w-2xl pr-8 mx-auto text-center">
                    <p class="my-5 text-base font-medium tracking-tight text-indigo-500 uppercase">Nuestros servicios brindados
                    </p>
                    <h2
                        class="text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl lg:text-5xl xl:text-6xl">
                        Referencias</h2>
                    <p class="my-6 text-xl font-medium text-gray-500">Estas son algunas de las firmas que confiaron en nosotros.</p>

                </div>

                <div class="flex flex-col items-center justify-center max-w-2xl py-8 mx-auto xl:flex-row xl:max-w-full">
                    <div class="w-full xl:w-1/2 xl:pr-8">
                        <blockquote
                            class="flex flex-col-reverse items-center justify-between w-full col-span-1 p-6 text-center transition-all duration-200 bg-gray-100 rounded-lg md:flex-row md:text-left hover:bg-white hover:shadow ease">
                            <div class="flex flex-col pr-8">
                                <div class="relative pl-12">
                                    <svg class="absolute left-0 w-10 h-10 text-indigo-500 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125">
                                        <path
                                            d="M30.7 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2C12.7 83.1 5 72.6 5 61.5c0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S30.7 31.6 30.7 42zM82.4 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2-11.8 0-19.5-10.5-19.5-21.6 0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S82.4 31.6 82.4 42z" />
                                    </svg>
                                    <p class="mt-2 text-base text-gray-600">Muy bueno y facil de usar.
                                    </p>
                                </div>

                                <h3 class="pl-12 mt-3 text-base font-medium leading-5 text-gray-800 truncate">Puerto Tabla <span class="mt-1 text-sm leading-5 text-gray-500 truncate"> - Carlos Casares</span></h3>
                                <p class="mt-1 text-sm leading-5 text-gray-500 truncate"></p>
                            </div>
                            <img class="flex-shrink-0 object-cover w-24 h-24 mb-5 bg-gray-300 rounded-full md:mb-0"
                                src="https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2694&q=80"
                                alt="">
                        </blockquote>
                        <blockquote
                            class="flex flex-col-reverse items-center justify-between w-full col-span-1 p-6 mt-16 mb-16 text-center transition-all duration-200 bg-gray-100 rounded-lg md:flex-row md:text-left hover:bg-white hover:shadow ease xl:mb-0">
                            <div class="flex flex-col pr-10">
                                <div class="relative pl-12">
                                    <svg class="absolute left-0 w-10 h-10 text-indigo-500 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 125">
                                        <path
                                            d="M30.7 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2C12.7 83.1 5 72.6 5 61.5c0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S30.7 31.6 30.7 42zM82.4 42c0 6.1 12.6 7 12.6 22 0 11-7.9 19.2-18.9 19.2-11.8 0-19.5-10.5-19.5-21.6 0-19.2 18-44.6 29.2-44.6 2.8 0 7.9 2 7.9 5.4S82.4 31.6 82.4 42z" />
                                    </svg>
                                    <p class="mt-2 text-base text-gray-600">Muy buen servicio y asistencia.</p>
                                </div>
                                <h3 class="pl-12 mt-3 text-base font-medium leading-5 text-gray-800 truncate">Seven <span class="mt-1 text-sm leading-5 text-gray-500 truncate">- Carlos Casares</span></h3>
                                <p class="mt-1 text-sm leading-5 text-gray-500 truncate"></p>
                            </div>
                            <img class="flex-shrink-0 object-cover w-24 h-24 mb-5 bg-gray-300 rounded-full md:mb-0"
                                src="https://images.unsplash.com/photo-1546820389-44d77e1f3b31?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1400&q=80"
                                alt="">
                        </blockquote>
                    </div>
                </div>


            </div>
        </div>
    </div> --}}
    <!-- TESTIMONIALS END-->


    <footer class="px-2 py-5 text-gray-100 bg-primary-50 border-t border-primary-300">
        <div class="container flex flex-col justify-between max-w-6xl px-1 mx-auto overflow-hidden lg:flex-row">
            <div class="w-full flex items-center justify-center gap-5 sm:text-left lg:w-1/4 text-center lg:text-left">
                <a href="/"
                    class="flex sm:justify-start text-center sm:text-left justify-center">
                        <img class="h-12 w-12 object-cover rounded-2xl" src="{{asset($company->image_logo_uri.$company->image_logo)}}" alt="">
                </a>
                <p class="text-lg font-bold text-primary-700">{{$company->name}}</p>
            </div>

            <div class="block w-full pl-10 mt-6 text-sm lg:w-3/4 sm:flex lg:mt-0">
                <ul class="flex flex-col w-full p-0 font-medium text-left text-gray-700 list-none">
                    <li class="inline-block px-3 py-2 mt-5 font-bold tracking-wide text-gray-800 uppercase md:mt-0">
                        Datos</li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-primary-600">{{$company->adress}}</a>
                    </li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-primary-600">{{$company->phone}}</a>
                    </li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-primary-600">{{$company->city}}</a>
                    </li>
                </ul>

                <ul class="flex flex-col w-full p-0 font-medium text-left text-gray-700 list-none">
                    <li class="inline-block px-3 py-2 mt-5 font-bold tracking-wide text-gray-800 uppercase md:mt-0">
                        Contacto</li>
                    <li><a href="#_"
                            class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-primary-600">{{$company->email}}</a>
                    </li>
                    <li><a href="#_" class="inline-block px-3 py-2 text-gray-500 no-underline hover:text-primary-600">{{$company->url}}</a></li>
                </ul>

                <div class="flex flex-col w-full text-gray-700">
                    <div class="inline-block px-3 py-2 mt-5 mb-3 font-bold text-gray-800 uppercase md:mt-0">Redes Sociales</div>

                    <div class="flex items-center justify-center sm:justify-start sm: px-3 gap-3">

                        @foreach ($company->socialMedia as $item)
                            
                            <a href="https://{{$item->pivot->url}}" target="_blank" >
                                <x-sistem.icons.for-icons-social :icon="$item->slug" class="hover:fill-primary-600" />
                            </a>
                            
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="pt-4 mt-10 text-center text-gray-900 border-t border-primary-300">© {{date('Y')}} Femaser. All rights reserved.</div>
    </footer>

    <!-- a little JS for the mobile nav button -->
    <script>
        if (document.getElementById('nav-mobile-btn')) {
            document.getElementById('nav-mobile-btn').addEventListener('click', function () {
                if (this.classList.contains('close')) {
                    document.getElementById('nav').classList.add('hidden');
                    this.classList.remove('close');
                } else {
                    document.getElementById('nav').classList.remove('hidden');
                    this.classList.add('close');
                }
            });
        }
    </script>
</body>

</x-guest-layout>