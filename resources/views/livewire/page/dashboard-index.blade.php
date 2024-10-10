<div>

    {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum 
        title_1="Inicio"
        link_1="{{ route('dashboard.index') }}"
        />

        <x-pages.menus.title-and-btn>

        @slot('title')
            <x-pages.titles.title-pages title="Bienvenido {{auth()->user()->name}}"/>
        @endslot

        @slot('button')
            <span class="font-bold italic">{{ auth()->user()->company->membership->name }}</span>
        @endslot
        </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    {{-- enlace a pagina web --}}
        <div class="my-2 flex flex-col lg:flex-row justify-between items-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 w-full">

            <span class="font-bold text-gray-600 text-xl mb-2 lg:mb-0">{{auth()->user()->company->name}}</span>

            <a href="{{ auth()->user()->company->url }}" target="_blank" class="flex items-center justify-center gap-1">
                <p class="flex items-center flex-col gap-1">
                    <span class="">{{ auth()->user()->company->url }}</span>
                </p>

                <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a> 

        </div>
    {{-- enlace a pagina web --}}
    
    {{-- portada y logo --}}
        <div class="grid grid-cols-2 gap-3 mb-2">

            <div class="relative mx-auto">
                <x-pages.libraries.lightbox.img-tumb-lightbox 
                    class_w_h="h-32 w-32 sm:h-64 sm:w-64 mx-auto"
                    :uri="auth()->user()->company->image_hero_uri" 
                    :name="auth()->user()->company->image_hero"    
                />
                <p class="absolute top-0 right-0 p-2 rounded-bl-xl bg-yellow-800 text-white">Portada</p>
            </div>

            <div class="relative mx-auto">
                <x-pages.libraries.lightbox.img-tumb-lightbox 
                    class_w_h="h-32 w-32 sm:h-64 sm:w-64 mx-auto"
                    :uri="auth()->user()->company->image_logo_uri" 
                    :name="auth()->user()->company->image_logo"    
                />
                <p class="absolute top-0 right-0 p-2 rounded-bl-xl bg-yellow-800 text-white">Logo</p>
            </div>

        </div>
    {{-- portada y logo --}}
    
    {{-- logo de carga --}}
        <x-pages.spinners.loading-spinner wire:loading.delay />
    {{-- end logo de carga --}}

    {{-- mini datos --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 mb-8">
        
            @can('memberships.index')
                <div>
                    <x-pages.cards.mini-date 
                        href="{{route('memberships.index')}}" 
                        title="Membresias" 
                        date="{{ $memberships->count() }}"
                            >
                            <x-sistem.icons.for-icons-app icon="membership"/>
                    </x-pages.cards.mini-date>            
                </div>
            @endcan

            @can('companies.index')
                <div>
                    <x-pages.cards.mini-date 
                        href="{{route('companies.index')}}" 
                            title="Empresas"
                            date="{{ $companies->count() }}"
                            >
                            <x-sistem.icons.for-icons-app icon="company"/>
                    </x-pages.cards.mini-date>         
                </div>
            @endcan

            @can('users.index')
                <div>
                    <x-pages.cards.mini-date 
                        href="{{route('users.index')}}" 
                        title="Usuarios" 
                        date="{{ $users->count() }}"
                            >
                            <x-sistem.icons.for-icons-app icon="user"/>
                        </x-pages.cards.mini-date>           
                </div>
            @endcan

            @can('levels.index')
                <div>
                    <x-pages.cards.mini-date 
                        href="{{route('levels.index')}}" 
                        title="Categorias Generales"
                        date_total="{{ auth()->user()->company->membership->level }}" 
                        date="{{ $levels->count() }}"
                        >
                        <x-sistem.icons.for-icons-app icon="level"/>
                    </x-pages.cards.mini-date>
                </div>
            @endcan
            
            @can('categories.index')
                <div>
                    <x-pages.cards.mini-date                     
                        href="{{route('categories.index')}}"
                        title="Categorias" 
                        date_total="{{ auth()->user()->company->membership->category }}"
                        date="{{ $categories->count() }}"
                        >
                        <x-sistem.icons.for-icons-app icon="category"/>
                    </x-pages.cards.mini-date>
                </div>
            @endcan

            @can('products.index')
                <div>
                    <x-pages.cards.mini-date 
                        href="{{route('products.index')}}" 
                        title="Productos" 
                        date_total="{{ auth()->user()->company->membership->product }}" 
                        date="{{ $products->count() }}"
                        >
                        <x-sistem.icons.for-icons-app icon="product"/>
                    </x-pages.cards.mini-date>
                </div>
            @endcan

            @can('tags.index')
                <div>
                    <x-pages.cards.mini-date 
                        href="{{route('tags.index')}}" 
                        title="Etiquetas" 
                        date_total="{{ auth()->user()->company->membership->tag }}" 
                        date="{{ $tags->count() }}"
                        >
                        <x-sistem.icons.for-icons-app icon="tag"/>
                    </x-pages.cards.mini-date>
                </div>
            @endcan
    
        </div>
    {{-- end mini datos --}}

    @push('scripts')

    <script src="{{ asset('lib/toastr/toastr-message.js') }}"></script>
    <script>
        Livewire.on('toastrError', (message) => {
          toastrError(message)
        })
        Livewire.on('toastrSuccess', (message) => {
          toastrSuccess(message)
        })
    </script>
  
  @endpush

</div>
