<div>
    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Bienvenido {{auth()->user()->name}}">
        <div class="flex flex-row gap-3 items-center">
            <span class="font-bold italic">{{ auth()->user()->company->membership->name }}</span>
            <x-sistem.icons.for-icons-app icon="membership" class="w-6 h-6"/>
        </div>
    </x-sistem.menus.title-and-btn>

    {{-- enlace a pagina web --}}
    <div class="my-2 flex flex-col lg:flex-row justify-between items-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 w-full">

        <span class="font-bold text-gray-600 text-xl mb-2 lg:mb-0">{{auth()->user()->company->name}}</span>

        <a href="https://{{ auth()->user()->company->url }}" target="_blank" class="flex items-center justify-center gap-1">
            <p class="flex items-center flex-col gap-1">
                <x-sistem.icons.for-icons-app icon="social_media" class="w-6 h-6"/>
                <span class="">{{ auth()->user()->company->url }}</span>
            </p>

            <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a> 

    </div>
    
    {{-- portada y logo --}}
    <div class="flex flex-col lg:flex-row justify-center items-center gap-3 mb-2">

        <div class="relative w-full sm:w-auto">
            <x-sistem.lightbox.img-tumb-lightbox 
                class="h-64 w-full sm:w-64 p-1 bg-gray-200"
                :uri="auth()->user()->company->image_hero_uri" 
                :name="auth()->user()->company->image_hero"    
            />
            <p class="absolute top-0 right-0 p-2 rounded-bl-xl bg-primary-800 text-white">Portada</p>
        </div>

        <div class="relative w-full sm:w-auto">
            <x-sistem.lightbox.img-lightbox 
                class="h-64 w-full sm:w-64 p-1 bg-gray-200"
                :uri="auth()->user()->company->image_logo_uri" 
                :name="auth()->user()->company->image_logo"    
            />
            <p class="absolute top-0 right-0 p-2 rounded-bl-xl bg-primary-800 text-white">Logo</p>
        </div>

    </div>
    
    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- mini datos --}}
    <div class="grid gap-3 mb-8 lg:grid-cols-2 xl:grid-cols-4">
       
        @can('memberships.index')
    <div>
    <x-sistem.cards.mini-date 
            href="{{route('memberships.index')}}" 
            title="Membresias" 
            :date="$memberships->count()"
                >
                <x-sistem.icons.for-icons-app icon="membership" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>            
    </div>
    @endcan

        @can('companies.index')
    <div>
    <x-sistem.cards.mini-date 
            href="{{route('companies.index')}}" 
                title="Empresas"
                :date="$companies->count()"
                >
                <x-sistem.icons.for-icons-app icon="company" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>         
    </div>
    @endcan

        @can('users.index')
    <div>
    <x-sistem.cards.mini-date 
            href="{{route('users.index')}}" 
            title="Usuarios" 
            :date="$users->count()"
                >
                <x-sistem.icons.for-icons-app icon="user" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>           
    </div>
    @endcan

        @can('levels.index')
    <div>
    <x-sistem.cards.mini-date 
                href="{{route('levels.index')}}" 
                title="Categorias Generales"
                :date_total="auth()->user()->company->membership->level" 
                :date="$levels->count()"
                >
                <x-sistem.icons.for-icons-app icon="level" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>
    </div>
    @endcan
        
        @can('categories.index')
    <div>
    <x-sistem.cards.mini-date                     
                href="{{route('categories.index')}}"
                title="Categorias" 
                :date_total="auth()->user()->company->membership->category"
                :date="$categories->count()"
                >
                <x-sistem.icons.for-icons-app icon="category" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>
    </div>
    @endcan

        @can('products.index')
    <div>
    <x-sistem.cards.mini-date 
                href="{{route('products.index')}}" 
                title="Productos" 
                :date_total="auth()->user()->company->membership->product" 
                :date="$products->count()"
                >
                <x-sistem.icons.for-icons-app icon="product" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>
    </div>
    @endcan

        @can('tags.index')
    <div>
    <x-sistem.cards.mini-date 
                href="{{route('tags.index')}}" 
                title="Etiquetas" 
                :date_total="auth()->user()->company->membership->tag" 
                :date="$tags->count()"
                >
                <x-sistem.icons.for-icons-app icon="tag" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>
    </div>
    @endcan

        @can('suggestions.index')
    <div>
    <x-sistem.cards.mini-date 
                href="{{route('suggestions.index')}}" 
                title="Sugerencias" 
                :date_total="auth()->user()->company->membership->suggestion" 
                :date="$suggestions->count()"
                >
                <x-sistem.icons.for-icons-app icon="suggestion" class="w-6 h-6"/>
            </x-sistem.cards.mini-date>
    </div>
    @endcan
 
    </div>

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
