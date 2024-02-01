<div>
  
  
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />
      
    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Niveles">

        <x-sistem.buttons.primary-btn 
            title="Agregar" 
            wire:click="createActionModal" 
            wire:loading.attr="disabled">
            @slot('icon')
                <x-sistem.icons.hi-plus-circle/>
            @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
      <p>Agregue categorias generales como "Bebidas", "Comidas", "Postres" o "Menu infantil". Los que se agreguen se podran asociar a un producto y luego poder ser filtrados en la pagina por cada rubro.</p>
    </x-sistem.menus.text-info>
  
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
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Creado por</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
            
                        @foreach ($levels as $item)
                        <tr wire:key="field-level-{{ Hash::make($item->id) }}">

                          <td class="text-center"><p>{{$item->id}}</p></td>
                          <td>
                            <div class="actions">
                              <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                              <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                                wire:loading.attr="disabled" />
                            </div>
                          </td>

                          <td class="sm:min-w-32">
                            @if ($item->image_hero)
                            <img class="block h-10 w-10 sm:h-32 sm:w-32 object-cover" src="{{$item->image_hero_uri.$item->image_hero}}" alt="imagen producto">                            
                            @else
                            <img class=" h-10 w-10 sm:h-32 sm:w-32 object-cover" src="archives/sistem/img/withoutImage.jpg" alt="imagen producto">
                            @endif
                          </td>

                          <td><p>{{$item->name}}</p></td>
                          <td><p>{{$item->description}}</p></td>
                          <td><p>{{$item->user->lastname}}, {{$item->user->name}}</p></td>

                          <td class="text-center">
                            <span class="line-clamp-2 {{$item->status == '1' ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300'}}">
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
        {{ $levels->onEachSide(1)->links() }}
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

            <x-sistem.buttons.delete-btn wire:click="deleteLevel()" wire:loading.attr="disabled"
            title="Borrar" autofocus/>
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
            {{ __($level ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">
            <form class="grid gap-2 mt-2">

              <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    autofocus />
                <x-sistem.forms.input-error for="name" />
              </div>
                
              <div>
                <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingresar una breve descripcion') }}"
                    wire:model="description" />
                <x-sistem.forms.input-error for="description" />
              </div>

              <div>
                <label for="status" class="flex items-center">
                    <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                </label>
              </div>

              {{-- imagen de categoria --}}
              <div>
                <h2 class="text-center font-bold text-xl">Imagen del nivel</h2>
        
                <div>
                    <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen del nivel') }}" />
                    <x-sistem.forms.input-form id="image_hero_new" type="file" wire:model="image_hero_new" accept="image/*"
                        />
                    <x-sistem.forms.input-error for="image_hero_new" />
                </div>
        
                <div class="grid grid-cols-1 gap-3">
        
                    <div class="">
                        <p class="mb-1">Imagen del nivel actual:</p>
                        <div class="w-64 h-64 mx-auto relative">
                            @if ($this->image_hero && $this->image_hero != '')
                                <img src="{{asset($this->image_hero_uri.$this->image_hero)}}" alt="imagen" class="w-64 h-64 object-cover rounded-md" />
                                <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">Eliminar</button>
                            @else
                                <img class="w-64 h-64 object-cover rounded-md" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
                            @endif
                        </div>
                    </div>
                    
                    <div class="">
        
                        <div wire:loading wire:target="image_hero_new">
                            <x-sistem.spinners.loading-spinner/>
                        </div>
        
                        <p class="mb-1">Imagen del nivel nueva:</p>
                        @if ($image_hero_new) 
                            <div class="w-64 h-64 mx-auto relative">
                                <img class="relative w-64 h-64 object-cover rounded-md" src="{{ $image_hero_new->temporaryUrl() }}">
                            </div>
                        @else
                            <p class="text-center italic">No se ha agregado una imagen nueva</p>
                        @endif
                    </div>
                </div>
            </div>

            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{$level ? 'Actualizar' : 'Guardar'}}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>


</div>