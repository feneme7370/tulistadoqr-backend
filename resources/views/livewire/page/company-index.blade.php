<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Empresas">
        <x-sistem.buttons.primary-btn 
            title="Agregar" 
            wire:click="createActionModal" 
            wire:loading.attr="disabled">
            @slot('icon')
              <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- input buscador y filtro de activos --}}
    <x-sistem.filter.search-active placeholder="Buscar por nombre o email"/>

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- listado --}}
    @include('livewire.page.tables-layouts.company-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $companies->onEachSide(1)->links() }}</div>

    <!-- Modal para crear y editar -->
    @include('livewire.page.forms-layouts.company-form')


    @push('scripts')
      <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
      <script>
        Livewire.on('deleteCompany', (event, nameDispatch) => {
          sweetalert2Delete(event, 'deleteCompanyId')
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