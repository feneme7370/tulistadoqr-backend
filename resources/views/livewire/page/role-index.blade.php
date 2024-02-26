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

      {{-- listado --}}
  <div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Nombre</th>
              <th>Guard Name</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($roles as $item)
            <tr>

              <td class="with-id-columns">
                <p>{{$item->id}}</p>
              </td>
              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  {{-- <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                    wire:loading.attr="disabled" /> --}}
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteRole', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td>
                <p>{{$item->name}}</p>
              </td>
              <td>
                <p>{{$item->guard_name}}</p>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>

    {{-- Paginacion --}}
    <div class="mt-2">
        {{ $roles->onEachSide(1)->links() }}
      </div>

        <!-- Modal para crear y editar -->
  <x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
      {{ __($role ? 'Editar' : 'Agregar') }}
    </x-slot>

    <x-slot name="content">
      <form class="grid gap-2 mt-2">

        <div>
          <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
          <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
          <x-sistem.forms.input-error for="name" />
        </div>

        <div>
          <x-sistem.forms.label-form for="guard_name" value="{{ __('Guard Name') }}" />
          <x-sistem.forms.input-form id="guard_name" type="text" placeholder="{{ __('Guard Name') }}" wire:model="guard_name" />
          <x-sistem.forms.input-error for="guard_name" />
        </div>

        {{-- <div>
            <x-sistem.forms.label-form for="role_permissions" value="{{ __('Permisos') }}" />
            <x-sistem.forms.select-form multiple wire:model="role_permissions" id="role_permissions">
                @foreach ($permissions as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="role_permissions" />
        </div> --}}
        @foreach ($permissions as $item)
        <div class="flex gap-1 items-center">
            <x-sistem.forms.checkbox-form :value="$item->id" wire:model="role_permissions" id="role_permissions"/>
            <x-sistem.forms.label-form for="role_permissions" :value="$item->name"/>
        </div>
        @endforeach
      </form>

    </x-slot>

    <x-slot name="footer">
      <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
      <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
        title="{{$role ? 'Actualizar' : 'Guardar'}}">
        <div wire:loading>
          <x-sistem.spinners.loading-spinner-btn />
        </div>
      </x-sistem.buttons.primary-btn>
    </x-slot>
  </x-sistem.modal.dialog-modal>

      @push('scripts')
      <script>
            document.addEventListener('livewire:init', () => {
              Livewire.on('deleteRole', (event) => {
                Swal.fire({
                  title: 'Quieres eliminar el registro',
                  text: "Se eliminara de forma definitiva",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#7e22ce',
                  cancelButtonText: 'Cancelar',
                  confirmButtonText: 'Si, eliminar'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // eliminar dato
                      Livewire.dispatch('deleteRoleId', {id : event})
                    }
                  })
            });
        })
      </script>
    
      <script src="{{ asset('lib/toastify/toastify-message.js') }}"></script>
     <script>
          Livewire.on('toastifyError', (message) => {
            toastifyError(message)
          })
          Livewire.on('toastifySuccess', (message) => {
            toastifySuccess(message)
          })
     </script>
      @endpush
</div>
