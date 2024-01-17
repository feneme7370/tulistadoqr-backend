<div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
    <div @click.away="open = false" class="flex flex-col flex-shrink-0 md:min-h-screen w-full text-gray-700 bg-white md:w-64 dark-mode:text-gray-200 dark-mode:bg-gray-800" x-data="{ open: false }">
        <div class="md:fixed">

            <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                <a href="{{route('dashboard.index')}}" class="mx-auto tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <x-sistem.menus.application-logo />
                </a>
                <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">

                <div class="flex flex-col gap-10">

                    <div>
                        <x-sistem.navlinks.navlink-sidebar-flowtrail
                            href="{{ route('dashboard.index') }}"
                            title="{{auth()->user()->email}}"
                        />
                    </div>
                    <div>
          
                        <x-sistem.navlinks.navlink-sidebar-flowtrail
                            href="{{ route('dashboard.index') }}"
                            :active="request()->routeIs('dashboard.index')"
                            title="Dashboard"
                        >
                            <x-sistem.icons.hi-home/>
                        </x-sistem.navlinks.navlink-sidebar-flowtrail>

                        @can('memberships.index')
                            <x-sistem.navlinks.navlink-sidebar-flowtrail
                                href="{{ route('memberships.index') }}"
                                :active="request()->routeIs('memberships.index')"
                                title="Membresias"
                                >
                                <x-sistem.icons.hi-currency-dollar/>
                            </x-sistem.navlinks.navlink-sidebar-flowtrail> 
                        @endcan

                        @can('companies.index') 
                            <x-sistem.navlinks.navlink-sidebar-flowtrail
                                href="{{ route('companies.index') }}"
                                :active="request()->routeIs('companies.index')"
                                title="Empresas"
                                >
                                <x-sistem.icons.hi-building-office/>
                            </x-sistem.navlinks.navlink-sidebar-flowtrail>
                        @endcan

                        @can('users.index')
                            <x-sistem.navlinks.navlink-sidebar-flowtrail
                                href="{{ route('users.index') }}"
                                :active="request()->routeIs('users.index')"
                                title="Usuarios"
                                >
                                <x-sistem.icons.hi-users/>
                            </x-sistem.navlinks.navlink-sidebar-flowtrail>
                        @endcan

                        @can('levels.index')
                            <x-sistem.navlinks.navlink-sidebar-flowtrail
                                href="{{ route('levels.index') }}"
                                :active="request()->routeIs('levels.index')"
                                title="Nivel"
                                >
                                <x-sistem.icons.hi-list-bullet/>
                            </x-sistem.navlinks.navlink-sidebar-flowtrail>
                        @endcan

                        @can('categories.index')
                            <x-sistem.navlinks.navlink-sidebar-flowtrail
                                href="{{ route('categories.index') }}"
                                :active="request()->routeIs('categories.index')"
                                title="Categorias"
                                >
                                <x-sistem.icons.hi-queue-list/>
                            </x-sistem.navlinks.navlink-sidebar-flowtrail>
                        @endcan

                    </div>
    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
    
                        <x-sistem.navlinks.navlink-sidebar-flowtrail 
                            title="Cerrar Sesion"
                            href="#"
                            @click.prevent="$root.submit();"
                        >
                            <x-sistem.icons.hi-arrow-right-on-rectangle/>
                        </x-sistem.navlinks.navlink-sidebar-flowtrail>
                    </form>
                </div>

                {{-- <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        <span>Dropdown</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-700">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #1</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #2</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #3</a>
                        </div>
                    </div>
                </div> --}}
            </nav>
        </div>
    </div>