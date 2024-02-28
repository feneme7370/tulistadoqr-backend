<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Redes Sociales">
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
    <x-sistem.filter.search-active />

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
            
                        @foreach ($social_medias as $item)
                        <tr>

                          <td class="with-id-columns"><p>{{$item->id}}</p></td>
                          
                          <td class="with-actions-columns">
                            <div class="actions">
                              <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                              <x-sistem.buttons.delete-text wire:click="$dispatch('deleteSocialMedia', {{$item->id}})"
                                wire:loading.attr="disabled" />
                            </div>
                          </td>
                          <td>
                            <p>{{$item->name}}</p>
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
        {{ $social_medias->onEachSide(1)->links() }}
    </div>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
          {{ __($social_media ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">
            <form class="grid gap-2 mt-2">

              <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" name="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                     />
                <x-sistem.forms.input-error for="name" />
              </div>

            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{$social_media ? 'Actualizar' : 'Guardar'}}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>

    @push('scripts')
      <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
      <script>
        Livewire.on('deleteSocialMedia', (event, nameDispatch) => {
          sweetalert2Delete(event, 'deleteSocialMediaId')
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