<div>
  {{-- mensaje de alerta --}}
  <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
      :messageError="session('messageError')" 
  />

  {{-- titulo y boton --}}
  <x-sistem.menus.title-and-btn title="Etiquetas">
    <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
        @slot('icon')
        <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
        @endslot
    </x-sistem.buttons.primary-btn>
  </x-sistem.menus.title-and-btn>

  {{-- texto informativo --}}
  <x-sistem.menus.text-info>
    <p>Las etiquetas sirven reflejar una cualidad del producto, por ej. "Sin TACC", "Vegano", "Sin Sal", o si quiere aclarar algo como "Nuevo", "Oferta".</p>
  </x-sistem.menus.text-info>

  {{-- logo de carga --}}
  <x-sistem.spinners.loading-spinner wire:loading />

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
            </tr>
          </thead>
          <tbody>

            @foreach($tags as $item)
            <tr>

              <td class="with-id-columns"><p>{{$item->id}}</p></td>

              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteTag', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td><p>{{$item->name}}</p></td>

            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->
  </div>

  <!-- Modal para crear y editar -->
  <x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
      {{$tag ? 'Editar' : 'Agregar'}}
    </x-slot>

    <x-slot name="content">

      <form class="grid gap-2 mt-2">

        <div>
          <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
          <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
          <x-sistem.forms.input-error for="name" />
        </div>

      </form>

    </x-slot>

    <x-slot name="footer">
      <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
      <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled"
        title="{{$tag ? 'Actualizar' : 'Guardar'}}" />
    </x-slot>
  </x-sistem.modal.dialog-modal>

  @push('scripts')
    <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
    <script>
      Livewire.on('deleteTag', (event, nameDispatch) => {
        sweetalert2Delete(event, 'deleteTagId')
      });
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