<x-app-layout>

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Bienvenido {{auth()->user()->name}}">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- enlace a pagina web --}}
    <div class="my-2 flex flex-col sm:flex-row justify-between items-center p-5 text-base font-medium text-gray-500 rounded-lg bg-gray-50 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white w-full">
        <span class="font-bold text-gray-600 text-xl mb-2 sm:mb-0">Empresa: {{auth()->user()->company->name}}</span>
        <a href="https://{{ auth()->user()->company->url }}" target="_blank" class="inline-flex items-center justify-center ">
            <span class="w-full">Direccion de pagina web: {{ auth()->user()->company->url }}</span>

            <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a> 

    </div>

    {{-- portada y logo --}}
    <div class="grid gap-3 mb-2 md:grid-cols-2">
        <div class="max-w-96 h-64 mx-auto p-1 bg-gray-200 relative">
            @if (auth()->user()->company->image_hero)
                <img src="{{asset('archives/images/hero/'.auth()->user()->company->image_hero)}}" alt="imagen portada" class="w-full h-full object-cover rounded-sm" />
            @else
                <img class="w-full h-full object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
            @endif
            <p class="absolute top-0 right-0 p-2 bg-black text-white">Portada</p>
        </div>

        <div class="max-w-96 h-64 mx-auto p-1 bg-gray-200 relative">
            @if (auth()->user()->company->image_logo)
                <img src="{{asset('archives/images/logo/'.auth()->user()->company->image_logo)}}" alt="imagen logo" class="w-full h-full object-cover rounded-sm" />
            @else
                <img class="w-full h-full object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
            @endif
            <p class="absolute top-0 right-0 p-2 bg-black text-white">Logo</p>
        </div>

    </div>
      
    {{-- mini datos --}}
    <div class="grid gap-3 mb-8 md:grid-cols-2 xl:grid-cols-4">

       
        @can('memberships.index')
            <x-sistem.cards.mini-date 
            href="{{route('memberships.index')}}" 
            title="Membresias" 
            :date="$memberships"
                >
                <x-sistem.icons.hi-users/>
            </x-sistem.cards.mini-date>            
        @endcan

        @can('companies.index')
            <x-sistem.cards.mini-date 
            href="{{route('companies.index')}}" 
                title="Empresas"
                :date="$companies"
                >
                <x-sistem.icons.hi-building-office/>
            </x-sistem.cards.mini-date>         
        @endcan

        @can('users.index')
            <x-sistem.cards.mini-date 
            href="{{route('users.index')}}" 
            title="Usuarios" 
            :date="$users"
                >
                <x-sistem.icons.hi-users/>
            </x-sistem.cards.mini-date>           
        @endcan

        @can('levels.index')
            <x-sistem.cards.mini-date 
                href="{{route('levels.index')}}" 
                title="Niveles"
                :date_total="auth()->user()->company->membership->level" 
                :date="$levels"
                >
                <x-sistem.icons.hi-list-bullet/>
            </x-sistem.cards.mini-date>
        @endcan
        
        @can('categories.index')
            <x-sistem.cards.mini-date                     
                href="{{route('categories.index')}}"
                title="Categorias" 
                :date_total="auth()->user()->company->membership->category"
                :date="$categories"
                >
                <x-sistem.icons.hi-queue-list/>
            </x-sistem.cards.mini-date>
        @endcan

        @can('products.index')
            <x-sistem.cards.mini-date 
                href="{{route('products.index')}}" 
                title="Productos" 
                :date_total="auth()->user()->company->membership->product" 
                :date="$products"
                >
                <x-sistem.icons.hi-briefcase/>
            </x-sistem.cards.mini-date>
        @endcan

        @can('tags.index')
            <x-sistem.cards.mini-date 
                href="{{route('tags.index')}}" 
                title="Etiquetas" 
                :date_total="auth()->user()->company->membership->product" 
                :date="$tags"
                >
                <x-sistem.icons.hi-tag/>
            </x-sistem.cards.mini-date>
        @endcan

        @can('suggestions.index')
            <x-sistem.cards.mini-date 
                href="{{route('suggestions.index')}}" 
                title="Sugerencias" 
                :date_total="auth()->user()->company->membership->suggestion" 
                :date="$suggestions"
                >
                <x-sistem.icons.hi-star/>
            </x-sistem.cards.mini-date>
        @endcan
 
    </div>


</x-app-layout>
