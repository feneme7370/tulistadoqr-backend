<div class="p-2 rounded-lg mx-auto my-1 ">
    
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Configuracion">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info class="">
        <p>Ajuste todos los datos de la empresa, cargue la imagen de portada y su logo en caso que sea una imagen. Tambien puede descargar aqui su codigo QR que redirecciona al menu digital.</p>
    </x-sistem.menus.text-info>

    {{-- descargar QR --}}
    <div>
        <x-sistem.buttons.primary-btn wire:click="downloadQR" class="lg:mx-auto lg:mr-2" wire:loading.attr="disabled" wire:loading.class="opacity-50" title="Descargar QR"/>
    </div>

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />
    
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
