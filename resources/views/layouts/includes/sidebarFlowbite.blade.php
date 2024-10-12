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
                                    <x-sistem.icons.for-icons-app icon="dashboard" />
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.show') }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100   "
                                    role="menuitem">
                                    <x-sistem.icons.for-icons-app icon="user" />
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('config.index', auth()->user()->company->id ) }}"
                                    class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100   "
                                    role="menuitem">
                                    <x-sistem.icons.for-icons-app icon="config" />
                                    Configuracion
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-primary-100 w-full"
                                        role="menuitem">
                                        <x-sistem.icons.for-icons-app icon="logout" />
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
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('dashboard.index') }}"
                :active="request()->routeIs('dashboard.index')" title="Panel Principal">
                <x-sistem.icons.for-icons-app icon="dashboard" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
        
            
            {{-- listado superadmin --}}

            @role('superadmin')
                <li class="border-t border-primary-300"></li>

                @can('memberships.index')
                    <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('memberships.index') }}"
                        :active="request()->routeIs('memberships.index')" title="Membresias">
                        <x-sistem.icons.for-icons-app icon="membership" />
                    </x-sistem.navlinks.navlink-sidebar-flowbite>
                @endcan

                @can('companies.index')
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('companies.index') }}"
                    :active="request()->routeIs('companies.index')" title="Empresas">
                    <x-sistem.icons.for-icons-app icon="company" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
                @endcan

                @can('users.index')
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('users.index') }}"
                    :active="request()->routeIs('users.index')" title="Usuarios">
                    <x-sistem.icons.for-icons-app icon="user" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
                @endcan

                @can('roles.index')
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('roles.index') }}"
                    :active="request()->routeIs('roles.index')" title="Roles">
                    <x-sistem.icons.for-icons-app icon="role" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
                @endcan

                @can('roles.permission')
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('roles.permission') }}"
                    :active="request()->routeIs('roles.permission')" title="Permisos">
                    <x-sistem.icons.for-icons-app icon="permission" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
                @endcan

                @can('social_medias.index')
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('social_medias.index') }}"
                    :active="request()->routeIs('social_medias.index')" title="Redes Sociales">
                    <x-sistem.icons.for-icons-app icon="social_media" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
                @endcan

            @endrole

            <li class="border-t border-primary-300"></li>
    
            {{-- listado cliente --}}

            @can('config.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('config.index', auth()->user()->company_id) }}"
                :active="request()->routeIs('config.index')" title="Configuracion">
                <x-sistem.icons.for-icons-app icon="config" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('orders.index')
                
            <li class="border-t border-primary-300"></li>
            @endcan

            @can('orders.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('orders.index') }}"
                :active="request()->routeIs('orders.index')" title="Ordenes">
                <x-sistem.icons.for-icons-app icon="order" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('orders.detail')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('orders.detail') }}"
                :active="request()->routeIs('orders.detail')" title="Ordenes a elaborar">
                <x-sistem.icons.for-icons-app icon="order_detail" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('orders.sale')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('orders.sale') }}"
                :active="request()->routeIs('orders.sale')" title="Ventas">
                <x-sistem.icons.for-icons-app icon="sale" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('stocks.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('stocks.index') }}"
                :active="request()->routeIs('stocks.index')" title="Stock">
                <x-sistem.icons.for-icons-app icon="stock" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('clients.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('clients.index') }}"
                :active="request()->routeIs('clients.index')" title="Clientes">
                <x-sistem.icons.for-icons-app icon="client" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            <li class="border-t border-primary-300"></li>

            @can('levels.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('levels.index') }}"
                :active="request()->routeIs('levels.index')" title="Categoria General">
                <x-sistem.icons.for-icons-app icon="level" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('categories.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('categories.index') }}"
                :active="request()->routeIs('categories.index')" title="Categorias">
                <x-sistem.icons.for-icons-app icon="category" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('products.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('products.index') }}"
                :active="request()->routeIs('products.index')" title="Productos">
                <x-sistem.icons.for-icons-app icon="product" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('products.masive')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('products.masive') }}"
                :active="request()->routeIs('products.masive')" title="Productos Masivos">
                <x-sistem.icons.for-icons-app icon="product" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('products.price')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('products.price') }}"
                :active="request()->routeIs('products.price')" title="Precios Masivos">
                <x-sistem.icons.for-icons-app icon="price" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('tags.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('tags.index') }}"
                :active="request()->routeIs('tags.index')" title="Etiquetas">
                <x-sistem.icons.for-icons-app icon="tag" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            @can('suggestions.index')
            <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('suggestions.index') }}"
                :active="request()->routeIs('suggestions.index')" title="Sugerencias">
                <x-sistem.icons.for-icons-app icon="suggestion" />
            </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan

            <li class="border-t border-primary-300"></li>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-sistem.navlinks.navbutton-sidebar-flowbite title="Cerrar Sesion" type="submit">
                    <x-sistem.icons.for-icons-app icon="logout" />
                </x-sistem.navlinks.navbutton-sidebar-flowbite>
            </form>

            <li class="border-t border-primary-300"></li>

            @can('information.index')
                <x-sistem.navlinks.navlink-sidebar-flowbite href="{{ route('information.index') }}"
                    :active="request()->routeIs('information.index')" title="Informacion">
                    <x-sistem.icons.for-icons-app icon="info" />
                </x-sistem.navlinks.navlink-sidebar-flowbite>
            @endcan
        </ul>
        
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