{{-- navbar --}}
<nav class="fixed top-0 z-50 w-full bg-primary-700 border-b border-primary-300">
    <div class="px-3 py-3 sm:px-5 sm:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm bg-primary-300 text-primary-700 rounded-lg sm:hidden hover:bg-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-200 ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>

                {{-- logo izquierda --}}
                <a href="{{ route('dashboard.index') }}" class="flex ms-2 md:me-24">
                    {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                    --}}
                    <img src="{{asset('archives/sistem/img/TuMenuQR_favicon.png')}}" class="h-8 me-3"
                        alt="FlowBite Logo" />
                    <span
                        class="self-center text-gray-100 text-xl font-semibold sm:text-2xl whitespace-nowrap">TuListadoQR</span>
                </a>

            </div>

            <div class="flex items-center">
                <div class="flex items-center ms-3">

                    {{-- imagen en miniatura --}}
                    <div>
                        <button type="button" class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300 "
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                src="{{asset('archives/sistem/img/TuMenuQR_favicon.png')}}" alt="user photo">
                        </button>
                    </div>


                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 mb-1" role="none">
                                {{ auth()->user()->lastname }}, {{ auth()->user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate " role="none">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            {{-- <li>
                                <button id="darkModeToggle"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100   ">Modo
                                    Oscuro</button>

                            </li> --}}
                            <li>
                                <a href="{{ route('dashboard.index') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100   "
                                    role="menuitem">
                                    <x-sistem.icons.for-icons-app icon="dashboard" class="h-6 w-6" />
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.show') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100   "
                                    role="menuitem">
                                    <x-sistem.icons.for-icons-app icon="user" class="h-6 w-6" />
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('config.index', auth()->user()->company->id ) }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100   "
                                    role="menuitem">
                                    <x-sistem.icons.for-icons-app icon="config" class="h-6 w-6" />
                                    Configuracion
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100 w-full"
                                        role="menuitem">
                                        <x-sistem.icons.for-icons-app icon="logout" class="h-6 w-6" />
                                        Cerrar sesion
                                    </button>

                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- sidebar --}}
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-primary-100 border-r border-primary-300 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto mb-10">

        {{-- listado inicial --}}
        <ul class="space-y-2 font-medium">
            <li>
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('dashboard.index') }}"
                    :active="request()->routeIs('dashboard.index')" title="Panel Principal">
                    <x-sistem.icons.for-icons-app icon="dashboard" class="h-6 w-6" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
            </li>
        </ul>

        {{-- listado superadmin --}}

        @role('superadmin')
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-primary-300">

            {{-- item desplegable --}}
            {{-- <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100  "
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                        <path
                            d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">E-commerce</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  ">Products</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  ">Billing</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  ">Invoice</a>
                    </li>
                </ul>
            </li> --}}

            @can('memberships.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('memberships.index') }}"
                :active="request()->routeIs('memberships.index')" title="Membresias">
                <x-sistem.icons.for-icons-app icon="membership" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('companies.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('companies.index') }}"
                :active="request()->routeIs('companies.index')" title="Empresas">
                <x-sistem.icons.for-icons-app icon="company" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('users.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('users.index') }}"
                :active="request()->routeIs('users.index')" title="Usuarios">
                <x-sistem.icons.for-icons-app icon="user" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('roles.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('roles.index') }}"
                :active="request()->routeIs('roles.index')" title="Roles">
                <x-sistem.icons.for-icons-app icon="role" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('roles.permission')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('roles.permission') }}"
                :active="request()->routeIs('roles.permission')" title="Permisos">
                <x-sistem.icons.for-icons-app icon="permission" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('social_medias.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('social_medias.index') }}"
                :active="request()->routeIs('social_medias.index')" title="Redes Sociales">
                <x-sistem.icons.for-icons-app icon="social_media" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

        </ul>
        @endrole

        {{-- listado cliente --}}
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-primary-300">

            @can('config.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('config.index', auth()->user()->company_id) }}"
                :active="request()->routeIs('config.index')" title="Configuracion">
                <x-sistem.icons.for-icons-app icon="config" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('levels.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('levels.index') }}"
                :active="request()->routeIs('levels.index')" title="Categoria General">
                <x-sistem.icons.for-icons-app icon="level" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('categories.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('categories.index') }}"
                :active="request()->routeIs('categories.index')" title="Categorias">
                <x-sistem.icons.for-icons-app icon="category" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('products.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('products.index') }}"
                :active="request()->routeIs('products.index')" title="Productos">
                <x-sistem.icons.for-icons-app icon="product" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('products.price')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('products.price') }}"
                :active="request()->routeIs('products.price')" title="Precios Masivos">
                <x-sistem.icons.for-icons-app icon="price" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('tags.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('tags.index') }}"
                :active="request()->routeIs('tags.index')" title="Etiquetas">
                <x-sistem.icons.for-icons-app icon="tag" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('suggestions.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('suggestions.index') }}"
                :active="request()->routeIs('suggestions.index')" title="Sugerencias">
                <x-sistem.icons.for-icons-app icon="suggestion" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan


        </ul>

        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-primary-300">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-sistem.navlinks.navbutton-sidebar-flowbite title="Cerrar Sesion" type="submit">
                    <x-sistem.icons.for-icons-app icon="logout" class="h-6 w-6" />
                </x-sistem.navlinks.navbutton-sidebar-flowbite>
            </form>
        </ul>

        @can('information.index')
        <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-primary-300">
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('information.index') }}"
                :active="request()->routeIs('information.index')" title="Informacion">
                <x-sistem.icons.for-icons-app icon="info" class="h-6 w-6" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
        </ul> 
        @endcan
    </div>
</aside>

@push('scripts')

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const html = document.getElementById('html');
            const darkModeToggle = document.getElementById('darkModeToggle');

            // Verifica el estado actual del modo oscuro en el almacenamiento local
            const isDarkMode = localStorage.getItem('darkMode') === 'true';

            // Aplica la clase de modo oscuro si está activado
            if (isDarkMode) {
                html.classList.add('dark');
            }

            // Agrega un evento de clic al botón para cambiar el modo oscuro
            darkModeToggle.addEventListener('click', function () {
                // Cambia la clase del cuerpo y actualiza el estado en el almacenamiento local
                html.classList.toggle('dark');
                const updatedDarkModeState = html.classList.contains('dark');
                localStorage.setItem('darkMode', updatedDarkModeState);
            });
        });

    </script> --}}
@endpush