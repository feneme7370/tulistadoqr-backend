<div>
    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Bienvenido {{auth()->user()->name}}">
        <div class="flex flex-row gap-3 items-center">
            <span class="font-bold italic">{{ auth()->user()->company->membership->name }}</span>
            {{-- <x-sistem.icons.for-icons-app icon="membership"/> --}}
        </div>
    </x-sistem.menus.title-and-btn>

    {{-- enlace a pagina web --}}
    <div class="my-2 flex flex-col lg:flex-row justify-between items-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 w-full">

        <span class="font-bold text-gray-600 text-xl mb-2 lg:mb-0">{{auth()->user()->company->name}}</span>

        <a href="https://{{ auth()->user()->company->url }}" target="_blank" class="flex items-center justify-center gap-1">
            <p class="flex items-center flex-col gap-1">
                {{-- <x-sistem.icons.for-icons-app icon="social_media"/> --}}
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
                        {{-- <x-sistem.icons.for-icons-app icon="membership"/> --}}
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
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
                        {{-- <x-sistem.icons.for-icons-app icon="company"/> --}}
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
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
                        {{-- <x-sistem.icons.for-icons-app icon="user"/> --}}
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
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
                    {{-- <x-sistem.icons.for-icons-app icon="level"/> --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
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
                    {{-- <x-sistem.icons.for-icons-app icon="category"/> --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                    </svg>
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
                    {{-- <x-sistem.icons.for-icons-app icon="product"/> --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                    </svg>
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
                    {{-- <x-sistem.icons.for-icons-app icon="tag"/> --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
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
                    {{-- <x-sistem.icons.for-icons-app icon="suggestion"/> --}}
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                    </svg>
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
