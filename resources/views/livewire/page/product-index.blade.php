<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Productos">
        <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
            @slot('icon')
            <x-sistem.icons.hi-plus-circle />
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
                <table class="t_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Acciones</th>
                            <th>Productos</th>
                            <th>Nivel/Categoria</th>
                            <th>Precio</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $item)
                        <tr>
                            <td class="text-center"><p>{{$item->id}}</p></td>
                            
                            <td>
                                <div class="actions">
                                    <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                                        wire:loading.attr="disabled" />
                                    <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                                        wire:loading.attr="disabled" />
                                </div>
                            </td>

                            <td class="text-center"><p>{{$item->name}}</p></td>
                            <td><p>{{$item->level->name}} / {{$item->category->name}}</p></td>
                            <td class="text-center"><p>${{ number_format($item->price_original, 2,",",".") }}</p></td>

                            <td class="text-center">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight {{$item->status == '1' ? 'text-green-700 bg-green-100 dark:text-green-100 dark:bg-green-700' : 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700'}}   rounded-full  ">
                                    {{$item->status == '1' ? 'Activo' : 'Inactivo'}}
                                </span>
                            </td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Paginacion --}}
    <div class="mt-2">
        {{-- {{ $products->onEachSide(1)->links('pagination::windmill-pagination') }} --}}
        {{ $products->links() }}
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
            <x-sistem.buttons.normal-btn wire:click="$set('showDeleteModal', false)" wire:loading.attr="disabled"
                title="Cancelar" />

            <x-sistem.buttons.delete-btn wire:click="deleteProduct" wire:loading.attr="disabled"
                title="Borrar" autofocus />
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
            {{ __($product ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">

            <x-sistem.forms.validation-errors class="mb-4" />

            <form class="grid grid-cols-1 gap-2 mt-2">

                {{-- datos del producto --}}
                <h2 class="text-center font-bold text-xl">Datos del producto</h2>
        
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                        <x-sistem.forms.input-form id="name" type="name"
                            placeholder="{{ __('Nombre') }}" wire:model="name" autofocus />
                        <x-sistem.forms.input-error for="name" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="price_original" value="{{ __('Precio original') }}" />
                        <x-sistem.forms.input-form id="price_original" type="number"
                            placeholder="{{ __('Precio') }}" wire:model="price_original" />
                        <x-sistem.forms.input-error for="price_original" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="price_seller" value="{{ __('Precio de oferta') }}" />
                        <x-sistem.forms.input-form id="price_seller" type="number"
                            placeholder="{{ __('Precio de oferta') }}" wire:model="price_seller" />
                        <x-sistem.forms.input-error for="price_seller" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="quantity" value="{{ __('Cantidad') }}" />
                        <x-sistem.forms.input-form id="quantity" type="number"
                            placeholder="{{ __('Cantidad') }}" wire:model="quantity" />
                        <x-sistem.forms.input-error for="quantity" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                        <x-sistem.forms.textarea-form id="description"
                            placeholder="{{ __('Ingresar una breve descripcion') }}" wire:model="description" />
                        <x-sistem.forms.input-error for="description" />
                    </div>

                    <label for="status" class="flex items-center">
                        <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                    </label>

                    <div>
                        <x-sistem.forms.label-form for="level_id" value="{{ __('Nivel') }}" />
                        <x-sistem.forms.select-form wire:model="level_id" id="level_id">
                            @foreach ($levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </x-sistem.forms.select-form>
                        <x-sistem.forms.input-error for="level_id" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="category_id" value="{{ __('Categoria') }}" />
                        <x-sistem.forms.select-form wire:model="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </x-sistem.forms.select-form>
                        <x-sistem.forms.input-error for="category_id" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="product_tags" value="{{ __('Etiquetas') }}" />
                        <x-sistem.forms.select-form multiple wire:model="product_tags" id="product_tags">
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </x-sistem.forms.select-form>
                        <x-sistem.forms.input-error for="product_tags" />
                    </div>

                </div>


                {{-- imagen de portada empresa --}}
                <div>
                    <h2 class="text-center font-bold text-xl">Imagen principal del producto</h2>
            
                    <div>
                        <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen del producto') }}" />
                        <x-sistem.forms.input-form id="image_hero_new" type="file" wire:model="image_hero_new" accept="image/*"
                            />
                        <x-sistem.forms.input-error for="image_hero_new" />
                    </div>
            
                    <div class="grid grid-cols-1 gap-3">
            
                        <div class="">
                            <p class="mb-1">Imagen del producto actual:</p>
                            <div class="w-64 h-64 mx-auto relative">
                                @if ($this->image_hero && $this->image_hero != '')
                                    <img src="{{asset('archives/images/product_hero/'.$this->image_hero)}}" alt="imagen" class="w-64 h-64 object-cover rounded-md" />
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
            
                            <p class="mb-1">Imagen del producto nueva:</p>
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

                <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" />
            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
                title="Cancelar" />

            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled"
                title="{{$product ? 'Actualizar' : 'Guardar'}}" autofocus />
        </x-slot>
    </x-sistem.modal.dialog-modal>


</div>