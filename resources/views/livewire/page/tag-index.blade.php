<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Etiquetas">

        <x-sistem.buttons.primary-btn 
            title="Agregar" 
            wire:click="createActionModal" 
            wire:loading.attr="disabled">
            @slot('icon')
            <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
      <p>Las etiquetas sirven reflejar una cualidad del producto, por ej. "Sin TACC", "Vegano", "Sin Sal", o si quiere aclarar algo como "Nuevo", "Oferta".</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    {{-- <x-sistem.filter.search-only /> --}}
    <x-sistem.spinners.loading-spinner wire:loading wire:target="search" />

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
                            <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
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

    {{-- Paginacion --}}
    <div class="mt-2">
        {{ $tags->onEachSide(1)->links() }}
    </div>

    <!-- Modal para borrar -->
    <x-sistem.modal.dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Borrar') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Desea eliminar el registro?') }}
        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showDeleteModal', false)" wire:loading.attr="disabled" title="Cancelar" />

            <x-sistem.buttons.delete-btn wire:click="deleteTag" wire:loading.attr="disabled"
            title="Borrar" />
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
          {{$tag ? 'Editar' : 'Agregar'}}
        </x-slot>

        <x-slot name="content">

            <form class="grid gap-2 mt-2">

              <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                     />
                <x-sistem.forms.input-error for="name" />
              </div>

            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{$tag ? 'Actualizar' : 'Guardar'}}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <div>
      @push('scripts')
      <script>
            document.addEventListener('livewire:init', () => {
              Livewire.on('deleteTag', (event) => {
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
                      Livewire.dispatch('deleteTagId', {id : event})
                    }
                  })
            });
        })
      </script>
  
      <script>
        Livewire.on('toastifyTag', (mensaje) => {
          Toastify({
            text: mensaje,
            duration: 4000,
            // destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
              background: "#f0fdf4",
              color: "#166534",
            },
            onClick: function(){} // Callback after click
          }).showToast();
        })
      </script>
      @endpush
    </div>
</div>