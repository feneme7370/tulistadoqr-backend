<div>

  {{-- titulo y boton --}}
  <x-sistem.menus.title-and-btn title="Roles">

    <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
      @slot('icon')
      <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
      @endslot
    </x-sistem.buttons.primary-btn>

  </x-sistem.menus.title-and-btn>

  {{-- texto informativo --}}
  <x-sistem.menus.text-info>
    <p>Agregar o editar los tipos de roles.</p>
  </x-sistem.menus.text-info>

  {{-- logo de carga --}}
  <x-sistem.spinners.loading-spinner wire:loading />

  {{-- listado --}}
  @include('livewire.page.tables-layouts.role-table')

  {{-- Paginacion --}}
  <div class="mt-2">{{ $roles->onEachSide(1)->links() }}</div>

  <!-- Modal para crear y editar -->
  @include('livewire.page.forms-layouts.role-form')

  @push('scripts')
    <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
    <script>
      Livewire.on('deleteRole', (event, nameDispatch) => {
        sweetalert2Delete(event, 'deleteRoleId')
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
