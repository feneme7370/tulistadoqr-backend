<x-app-layout>

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Bienvenido {{auth()->user()->name}}">
        <span>{{auth()->user()->company->name}}</span>
    </x-sistem.menus.title-and-btn>

    <div class="w-full md:w-96 h-64 mx-auto mb-5 bg-gray-200 relative">
        @if (auth()->user()->company->image_hero)
            <img src="{{asset('storage/archives/images/hero/'.auth()->user()->company->image_hero)}}" alt="imagen portada" class="w-full h-full object-cover rounded-sm" />
            <img src="{{asset('storage/public/archives/images/hero/'.auth()->user()->company->image_hero)}}" alt="imagen portada" class="w-full h-full object-cover rounded-sm" />
            <img src="{{asset('archives/images/hero/'.auth()->user()->company->image_hero)}}" alt="imagen portada" class="w-full h-full object-cover rounded-sm" />
        @else
            <img class="w-full h-full object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
        @endif
        <p class="absolute top-0 right-0 p-2 bg-black text-white">Portada</p>
    </div>
      
    <div class="grid gap-3 mb-8 md:grid-cols-2 xl:grid-cols-4">

        {{-- <x-sistem.cards.mini-date 
            href="{{route('suggesteds.index')}}" 
            title="Destacados" 
            :date_total="auth()->user()->company->membership->suggested" 
            :date="$suggested"
            >
            <x-sistem.icons.hi-star/>
        </x-sistem.cards.mini-date> --}}

        
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
