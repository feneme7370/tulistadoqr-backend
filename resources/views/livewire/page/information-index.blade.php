<div>
  {{-- mensaje de alerta --}}
  <x-sistem.notifications.alerts 
    :messageSuccess="session('messageSuccess')" 
    :messageError="session('messageError')" 
  />

  {{-- titulo y boton --}}
  <x-sistem.menus.title-and-btn title="Informacion sobre Femaser">
    <div></div>
  </x-sistem.menus.title-and-btn>

  {{-- texto informativo --}}
  <x-sistem.menus.text-info>
    <p>Vea toda la informacion sobre Femaser, y su informacion de contacto.</p>
  </x-sistem.menus.text-info>

  <x-sistem.filter.bg-input class="mx-auto flex-col w-full md:w-1/2 p-2 pb-5 gap-5">
    <p class="font-bold text-2xl">{{ $femaser->name }}</p>

    <div class="w-1/3 border-t border-gray-300"></div>

    <div class="w-full text-center">
        <p>{{ $femaser->adress }}</p>
        <p>{{ $femaser->city }}</p>
    </div>

    <div class="w-1/3 border-t border-gray-300"></div>

    <div class="w-full text-center">
        <p>{{ $femaser->email }}</p>
    </div>

    <div class="w-1/3 border-t border-gray-300"></div>

    <div class="w-full text-center">
        <p><a class="hover:underline" href="https://{{ $femaser->url }}">{{ $femaser->url }}</a></p>
    </div>

    <div class="w-1/3 border-t border-gray-300"></div>

    <div class="w-full text-center">
        <p><Span>Whatsapp: </Span>{{ $femaser->socialMedia->where('slug', 'whatsapp')->first()->pivot->url }}</p>

        <a href="https://api.whatsapp.com/send/?phone={{ $femaser->socialMedia->where('slug', 'whatsapp')->first()->pivot->url }}&amp;text=" target="_blank"
            class="px-2 py-3 mt-5 text-base font-semibold text-center text-gray-100 bg-gray-900 rounded shadow-sm hover:bg-primary-600 flex flex-row gap-3 justify-center items-center w-auto">

            <x-sistem.icons.for-icons-social icon="whatsapp" class="fill-gray-100 h-6 w-6" />
            <span>Enviar Whatsapp</span>

        </a>
    </div>




  </x-sistem.filter.bg-input>
</div>
