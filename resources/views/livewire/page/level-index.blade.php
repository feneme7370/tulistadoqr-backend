<div>
  {{-- mensaje de alerta --}}
  <x-sistem.notifications.alerts 
    :messageSuccess="session('messageSuccess')" 
    :messageError="session('messageError')" 
  />

  {{-- titulo y boton --}}
  <x-sistem.menus.title-and-btn title="Categorias Generales">

    <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
      @slot('icon')
      <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
      @endslot
    </x-sistem.buttons.primary-btn>

  </x-sistem.menus.title-and-btn>

  {{-- texto informativo --}}
  <x-sistem.menus.text-info>
    <p>Agregue categorias generales como "Bebidas", "Comidas", "Postres" o "Menu infantil". Los que se agreguen se
      podran asociar a un producto y luego poder ser filtrados en la pagina por cada rubro.</p>
  </x-sistem.menus.text-info>

  {{-- input buscador y filtro de activos --}}
  <x-sistem.filter.search-active />

  {{-- logo de carga --}}
  <x-sistem.spinners.loading-spinner wire:loading />

  {{-- listado --}}
  @include('livewire.page.tables-layouts.level-table')

  {{-- Paginacion --}}
  <div class="mt-2">{{ $levels->onEachSide(1)->links() }}</div>

  <!-- Modal para crear y editar -->
  @include('livewire.page.forms-layouts.level-form')

  @push('scripts')  

    <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
    <script>
      Livewire.on('deleteLevel', (event, nameDispatch) => {
        sweetalert2Delete(event, 'deleteLevelId')
      });
    </script>

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