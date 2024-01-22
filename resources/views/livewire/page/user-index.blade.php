<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Usuarios">
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
    <x-sistem.filter.search-active placeholder="Buscar por apellido, nombre, email o empresa" />
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
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
            
                        @foreach ($users as $item)
                        <tr>

                          <td class="text-center"><p>{{$item->id}}</p></td>
                          <td>
                            <div class="actions">
                              <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                              <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                                wire:loading.attr="disabled" />
                            </div>
                          </td>   

                          <td><p class="font-bold">{{$item->lastname}}, {{$item->name}}</p></td>

                          <td><p>{{$item->email}}</p></td>
                          <td><p>{{$item->company->name}}</p></td>

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
        {{ $users->onEachSide(1)->links() }}
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

            <x-sistem.buttons.delete-btn wire:click="deleteUser()" wire:loading.attr="disabled"
            title="Borrar" autofocus/>
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
          {{ __($user ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">

            <form class="grid gap-2 mt-2">

              <x-sistem.forms.validation-errors class="mb-4" />
              
              <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    autofocus />
                <x-sistem.forms.input-error for="name" />
              </div>

              <div>
                <x-sistem.forms.label-form for="lastname" value="{{ __('Apellido') }}" />
                <x-sistem.forms.input-form id="lastname" type="text" placeholder="{{ __('Apellido') }}" wire:model="lastname"
                   />
                <x-sistem.forms.input-error for="lastname" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
                <x-sistem.forms.input-form id="email" type="email" placeholder="{{ __('Email') }}" wire:model="email"
                     />
                <x-sistem.forms.input-error for="email" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="phone" value="{{ __('Telefono') }}" />
                <x-sistem.forms.input-form id="phone" type="text" placeholder="{{ __('Telefono') }}" wire:model="phone"
                     />
                <x-sistem.forms.input-error for="phone" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="adress" value="{{ __('Direccion') }}" />
                <x-sistem.forms.input-form id="adress" type="text" placeholder="{{ __('Direccion') }}" wire:model="adress"
                     />
                <x-sistem.forms.input-error for="adress" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="birthday" value="{{ __('Fecha de nacimiento') }}" />
                <x-sistem.forms.input-form id="birthday" type="date" placeholder="{{ __('Fecha de nacimiento') }}" wire:model="birthday"
                     />
                <x-sistem.forms.input-error for="birthday" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="city" value="{{ __('Localidad') }}" />
                <x-sistem.forms.input-form id="city" type="text" placeholder="{{ __('Localidad') }}" wire:model="city"
                     />
                <x-sistem.forms.input-error for="city" />
              </div>

              {{-- <div>
                <x-sistem.forms.label-form for="social" value="{{ __('Redes sociales') }}" />
                <x-sistem.forms.input-form id="social" type="text" placeholder="{{ __('Redes Sociales') }}" wire:model="social"
                     />
                <x-sistem.forms.input-error for="social" />
              </div> --}}

              <div>
                <x-sistem.forms.label-form for="company_id" value="{{ __('Empresa') }}" />
                <x-sistem.forms.select-form wire:model="company_id">
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </x-sistem.forms.select-form>
                <x-sistem.forms.input-error for="company_id" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="description" value="{{ __('Descripcion del usuario') }}" />
                <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Descripcion') }}"
                    wire:model="description" />
                <x-sistem.forms.input-error for="description" />
              </div>

              <div>
                <label for="status" class="flex items-center">
                    <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                </label>
              </div>

              <div>
                <x-sistem.forms.label-form for="password" value="{{ __('Clave') }}" />
                <x-sistem.forms.input-form id="password" type="password" placeholder="{{ __('Clave') }}" wire:model="password"
                     />
                <x-sistem.forms.input-error for="password" />
              </div>

              <div>
                <x-sistem.forms.label-form for="password_confirmation" value="{{ __('Repetir clave') }}" />
                <x-sistem.forms.input-form id="password_confirmation" type="password" placeholder="{{ __('Repetir clave') }}" wire:model="password_confirmation"
                     />
                <x-sistem.forms.input-error for="password_confirmation" />
              </div>

            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{$user ? 'Actualizar' : 'Guardar'}}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>


</div>