<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" />

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

    {{-- listado --}}
    <div class="mx-auto">
            <!-- Ejemplo de una tarjeta -->

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="w-full whitespace-no-wrap">
                    <thead>
                      <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            
                        @foreach ($memberships as $item)
                        <tr class="text-gray-700 dark:text-gray-400">

                          <td class="px-4 py-3 text-sm">
                            {{$item->id}}
                          </td>

                          <td class="px-4 py-3 text-sm">
                            {{$item->name}}
                          </td>
                          <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight {{$item->status == '1' ? 'text-green-700 bg-green-100 dark:text-green-100 dark:bg-green-700' : 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700'}}   rounded-full  ">
                              {{$item->status == '1' ? 'Activo' : 'Inactivo'}}
                            </span>
                          </td>
                          <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                              <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                              <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                                wire:loading.attr="disabled" />
                            </div>
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
    <div class="mt-4">
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

            <x-sistem.buttons.delete-btn class="ml-3" wire:click="deleteMembership()" wire:loading.attr="disabled"
            title="Borrar" autofocus/>
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
            {{ __('Agregar') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Agregar un registro') }}

            <form {{-- method="POST" --}} class="grid gap-3 mt-5">

                <x-sistem.forms.label-form for="name" value="{{ __('Nombre de empresa') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    autofocus />
                <x-sistem.forms.input-error for="name" />
                
                
                <x-sistem.forms.label-form for="category" value="{{ __('Categorias') }}" />
                <x-sistem.forms.input-form id="category" type="text" placeholder="{{ __('Cantidad') }}" wire:model="category"
                     />
                <x-sistem.forms.input-error for="category" />
                
                <x-sistem.forms.label-form for="level" value="{{ __('Nivel') }}" />
                <x-sistem.forms.input-form id="level" type="text" placeholder="{{ __('Cantidad') }}" wire:model="level"
                     />
                <x-sistem.forms.input-error for="level" />
                
                <x-sistem.forms.label-form for="product" value="{{ __('Productos') }}" />
                <x-sistem.forms.input-form id="product" type="text" placeholder="{{ __('Cantidad') }}" wire:model="product"
                     />
                <x-sistem.forms.input-error for="product" />
                
                <x-sistem.forms.label-form for="user" value="{{ __('Usuarios') }}" />
                <x-sistem.forms.input-form id="user" type="text" placeholder="{{ __('Cantidad') }}" wire:model="user"
                     />
                <x-sistem.forms.input-error for="user" />
                
                <x-sistem.forms.label-form for="suggestion" value="{{ __('Sugerencias') }}" />
                <x-sistem.forms.input-form id="suggestion" type="text" placeholder="{{ __('Cantidad') }}" wire:model="suggestion"
                     />
                <x-sistem.forms.input-error for="suggestion" />
                


                <label for="status" class="flex items-center">
                    <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                </label>

            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" class="ml-3" wire:loading.attr="disabled" title="Guardar"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>


</div>