<div>
  {{-- mensaje de alerta --}}
  <x-sistem.notifications.alerts 
    :messageSuccess="session('messageSuccess')" 
    :messageError="session('messageError')" 
  />

    {{-- breadcrum, title y button --}}
      <x-pages.breadcrums.breadcrum 
      title_1="Inicio"
      link_1="{{ route('dashboard.index') }}"
      title_2="Informacion"
      link_2="{{ route('information.index') }}"
      />

      <x-pages.menus.title-and-btn>

      @slot('title')
          <x-pages.titles.title-pages title="Informacion sobre Femaser"/>
      @endslot

      @slot('button')
  
      @endslot
      </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

  {{-- texto informativo --}}
    <x-pages.menus.text-info>
      <p>Vea toda la informacion sobre Femaser, y su informacion de contacto.</p>
    </x-pages.menus.text-info>
  {{-- end texto informativo --}}

  {{-- date, videos --}}
    <div class="grid grid-cols-1 md:w-1/2 gap-5">
      <p class="font-bold mx-auto text-2xl">{{ $femaser->name }}</p>

      <div class="mx-auto w-1/3 border-t border-gray-300"></div>

      <div class="w-full text-center">
          <p>{{ $femaser->adress }}</p>
          <p>{{ $femaser->city }}</p>
      </div>

      <div class="mx-auto w-1/3 border-t border-gray-300"></div>

      <div class="w-full text-center">
          <p>{{ $femaser->email }}</p>
      </div>

      <div class="mx-auto w-1/3 border-t border-gray-300"></div>

      <div class="w-full text-center">
          <p><a class="hover:underline" href="{{ $femaser->url }}">{{ $femaser->url }}</a></p>
      </div>

      <div class="mx-auto w-1/3 border-t border-gray-300"></div>

      <div class="w-full text-center">
          <p><Span>Whatsapp: </Span>{{ $femaserWsp }}</p>

          <a href="https://api.whatsapp.com/send/?phone={{ $femaserWsp }}&amp;text=" target="_blank"
              class="px-2 py-3 mt-5 text-base font-semibold text-center text-gray-100 bg-gray-900 rounded shadow-sm hover:bg-primary-600 flex flex-row gap-3 justify-center items-center w-auto">

              <x-sistem.icons.for-icons-social icon="whatsapp" class="fill-gray-100 h-6 w-6" />
              <span>Enviar Whatsapp</span>

          </a>
      </div>
    
      <p class="font-bold text-center text-gray-800 text-lg">Ver videos tutoriales</p>

      <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">

        <a target="_blank" class="grid grid-cols-1 text-center gap-1 my-1 p-2 border border-gray-700 rounded hover:bg-gray-100 hover:shadow-md" href="https://www.youtube.com/watch?v=M-IPvuSCbBw">
          <img class="h-32 w-32 mx-auto" src="{{ asset('archives/sistem/img/1. Tutorial de la demo.png') }}" alt="imagen">
          <p>1. Tutorial de la demo</p>
        </a>
      
        <a target="_blank" class="grid grid-cols-1 text-center gap-1 my-1 p-2 border border-gray-700 rounded hover:bg-gray-100 hover:shadow-md" href="https://www.youtube.com/watch?v=l-gdZjUy4zs">
          <img class="h-32 w-32 mx-auto" src="{{ asset('archives/sistem/img/2. Acceso al admin y configuracion.png') }}" alt="imagen">
          <p>2. Acceso al admin y configuracion</p>
        </a>
      
        <a target="_blank" class="grid grid-cols-1 text-center gap-1 my-1 p-2 border border-gray-700 rounded hover:bg-gray-100 hover:shadow-md" href="https://www.youtube.com/watch?v=Tqt3u0vOQGU">
          <img class="h-32 w-32 mx-auto" src="{{ asset('archives/sistem/img/3. Categorias.png') }}" alt="imagen">
          <p>3. Categorias</p>
        </a>
      
        <a target="_blank" class="grid grid-cols-1 text-center gap-1 my-1 p-2 border border-gray-700 rounded hover:bg-gray-100 hover:shadow-md" href="https://www.youtube.com/watch?v=VMmibgjsDac">
          <img class="h-32 w-32 mx-auto" src="{{ asset('archives/sistem/img/4. Etiquetas y productos.png') }}" alt="imagen">
          <p>4. Etiquetas y productos</p>
        </a>
      
        <a target="_blank" class="grid grid-cols-1 text-center gap-1 my-1 p-2 border border-gray-700 rounded hover:bg-gray-100 hover:shadow-md" href="https://www.youtube.com/watch?v=hZd1BBSAp20">
          <img class="h-32 w-32 mx-auto" src="{{ asset('archives/sistem/img/5. Productos masivos y destacados.png') }}" alt="imagen">
          <p>5. Productos masivos y destacados</p>
        </a>
      
        <a target="_blank" class="grid grid-cols-1 text-center gap-1 my-1 p-2 border border-gray-700 rounded hover:bg-gray-100 hover:shadow-md" href="https://www.youtube.com/watch?v=cwZzhaNuI64">
          <img class="h-32 w-32 mx-auto" src="{{ asset('archives/sistem/img/6. Perfil e informacion.png') }}" alt="imagen">
          <p>6. Perfil e informacion</p>
        </a>
      </div>

    </div>
  {{-- end date, videos --}}
</div>
