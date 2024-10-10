<div>
    
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- breadcrum, title y button --}}
      <x-pages.breadcrums.breadcrum 
      title_1="Inicio"
      link_1="{{ route('dashboard.index') }}"
      title_2="Configuracion"
      link_2="#"
      />

      <x-pages.menus.title-and-btn>

      @slot('title')
          <x-pages.titles.title-pages title="Configuracion"/>
      @endslot

      @slot('button')
        <x-pages.buttons.primary-btn 
        title="Descargar QR" 
        wire:click="downloadQR" 
        >
        
        @slot('icon')
            <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
        @endslot

        </x-pages.buttons.primary-btn>
      @endslot
      </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    {{-- texto informativo --}}
      <x-pages.menus.text-info class="">
          <p>Ajuste todos los datos de la empresa, cargue la imagen de portada y su logo en caso que sea una imagen. Tambien puede descargar aqui su codigo QR que redirecciona al menu digital.</p>
      </x-pages.menus.text-info>
    {{-- end texto informativo --}}

    {{-- logo de carga --}}
      <x-pages.spinners.loading-spinner wire:loading.delay />
    {{-- end logo de carga --}}
    
    {{-- actualizar datos --}}
    @include('livewire.page.forms-layouts.config-form')

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
