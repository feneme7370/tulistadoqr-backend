<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Membresias">
        <x-sistem.buttons.primary-btn 
            title="Agregar" 
            wire:click="createActionModal" 
            wire:loading.attr="disabled">
            @slot('icon')
                <x-sistem.icons.hi-plus-circle/>
            @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- input buscador y filtro de activos --}}
    <x-sistem.filter.search-active />
    <x-sistem.spinners.loading-spinner wire:loading wire:target="search"/>

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
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
            
                        @foreach ($memberships as $item)
                        <tr wire:key="field-membership-{{ $item->id }}">
                          
                          <td class="text-center">
                            <p>{{$item->id}}</p>
                          </td>

                          <td>
                            <div class="actions">
                              <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                              <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                                wire:loading.attr="disabled" />
                            </div>
                          </td>

                          <td>
                            <p>{{$item->name}}</p>
                          </td>

                          <td class="text-center">
                            <span class="px-2 py-1 font-semibold leading-tight {{$item->status == '1' ? 'text-green-700 bg-green-100 dark:text-green-100 dark:bg-green-700' : 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700'}}   rounded-full  ">
                              {{$item->status == '1' ? 'Activo' : 'Inactivo'}}
                            </span>
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
        {{ $memberships->onEachSide(1)->links() }}
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

            <x-sistem.buttons.delete-btn wire:click="deleteMembership()" wire:loading.attr="disabled"
            title="Borrar" autofocus/>
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
          {{ __($membership ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">
          <form {{-- method="POST" --}} class="grid gap-2 mt-2">

            <x-sistem.forms.validation-errors class="mb-4" />
            
            <div>
              <x-sistem.forms.label-form for="name" value="{{ __('Nombre de la membresia') }}" />
              <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                  autofocus />
              <x-sistem.forms.input-error for="name" />
            </div>
                
            <div>
              <x-sistem.forms.label-form for="category" value="{{ __('Categorias') }}" />
              <x-sistem.forms.input-form id="category" type="text" placeholder="{{ __('Cantidad') }}" wire:model="category"
                   />
              <x-sistem.forms.input-error for="category" />
            </div>
                
            <div>
              <x-sistem.forms.label-form for="level" value="{{ __('Niveles') }}" />
              <x-sistem.forms.input-form id="level" type="text" placeholder="{{ __('Cantidad') }}" wire:model="level"
                   />
              <x-sistem.forms.input-error for="level" />
            </div>
                
            <div>
              <x-sistem.forms.label-form for="product" value="{{ __('Productos') }}" />
              <x-sistem.forms.input-form id="product" type="text" placeholder="{{ __('Cantidad') }}" wire:model="product"
                   />
              <x-sistem.forms.input-error for="product" />
            </div>
                
            <div>
              <x-sistem.forms.label-form for="user" value="{{ __('Usuarios') }}" />
              <x-sistem.forms.input-form id="user" type="text" placeholder="{{ __('Cantidad') }}" wire:model="user"
                   />
              <x-sistem.forms.input-error for="user" />
            </div>
                
            <div>
              <x-sistem.forms.label-form for="suggestion" value="{{ __('Sugerencias') }}" />
              <x-sistem.forms.input-form id="suggestion" type="text" placeholder="{{ __('Cantidad') }}" wire:model="suggestion"
                   />
              <x-sistem.forms.input-error for="suggestion" />
            </div>
                
            <div>
              <label for="status" class="flex items-center">
                  <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                  <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
              </label>
            </div>

          </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{ __($membership ? 'Actualizar' : 'Guardar') }}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>


</div>