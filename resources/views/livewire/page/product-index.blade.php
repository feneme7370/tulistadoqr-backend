<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" />

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
                            <th>Productos</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $item)
                        <tr>
                            <td class="text-center">
                                {{$item->id}}
                            </td>

                            <td>
                                <div class="flex items-center text-sm">
                                    <p class="font-semibold">{{$item->name}}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{$item->level->name}} / {{$item->category->name}}
                                    </p>
                                </div>
                            </td>

                            <td class="text-center">
                                ${{ number_format($item->price_original, 2,",",".") }}
                            </td>

                            <td class="text-center">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight {{$item->status == '1' ? 'text-green-700 bg-green-100 dark:text-green-100 dark:bg-green-700' : 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700'}}   rounded-full  ">
                                    {{$item->status == '1' ? 'Activo' : 'Inactivo'}}
                                </span>
                            </td>

                            <td>
                                <div class="actions">
                                    <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                                        wire:loading.attr="disabled" />
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

            <form {{-- method="POST" --}} class="grid gap-2 mt-2">
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                        <x-sistem.forms.input-form id="name" type="name"
                            placeholder="{{ __('Pizza napolitana, Coca Cola 750ml') }}" wire:model="name" autofocus />
                        <x-sistem.forms.input-error for="name" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="price_original" value="{{ __('Precio original') }}" />
                        <x-sistem.forms.input-form id="price_original" type="number"
                            placeholder="{{ __('Ingresar el precio') }}" wire:model="price_original" autofocus />
                        <x-sistem.forms.input-error for="price_original" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="price_seller" value="{{ __('Precio de oferta') }}" />
                        <x-sistem.forms.input-form id="price_seller" type="number"
                            placeholder="{{ __('Ingresar el precio') }}" wire:model="price_seller" autofocus />
                        <x-sistem.forms.input-error for="price_seller" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="quantity" value="{{ __('Cantidad') }}" />
                        <x-sistem.forms.input-form id="quantity" type="number"
                            placeholder="{{ __('Ingresar la cantidad') }}" wire:model="quantity" autofocus />
                        <x-sistem.forms.input-error for="quantity" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                        <x-sistem.forms.textarea-form id="description"
                            placeholder="{{ __('Incluye tomate, ajo, perejil y salsa') }}" wire:model="description" />
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
                        <x-sistem.forms.label-form for="product_tags" value="{{ __('Nivel') }}" />
                        <x-sistem.forms.select-form multiple wire:model="product_tags" id="product_tags">
                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </x-sistem.forms.select-form>
                        <x-sistem.forms.input-error for="product_tags" />
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="image_hero_nueva" value="{{ __('Imagen') }}" />
                        <x-sistem.forms.input-form id="image_hero_nueva" type="file" wire:model="image_hero_nueva"
                            accept="image/*" />
                        <x-sistem.forms.input-error for="image_hero_nueva" />
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-evenly mb-4">
                    <div class="w-64 h-64 relative">
                        <p class="mb-2">Imagen actual:</p>
                        @if ($this->image_hero && $this->image_hero != '')
                        <img src="{{asset('storage/images/product/'.$this->image_hero)}}" alt="imagen"
                            class="w-64 h-64 object-cover rounded-sm" />
                        <button wire:click='deleteImageEdit' type="button"
                            class="absolute top-7 right-2 p-2 bg-red-600 rounded-lg text-white">Eliminar</button>
                        @else
                        <img class="w-64 h-64 object-cover rounded-sm"
                            src="{{asset('storage/sistem/img/withoutImage.jpg')}}">
                        @endif
                    </div>
                    <div class="w-64 h-64 relative">
                        <p wire:loading>Cargando</p>
                        <p class="mb-2">Imagen nueva:</p>
                        @if ($image_hero_nueva)
                        <img class="w-64 h-64 object-cover rounded-sm" src="{{ $image_hero_nueva->temporaryUrl() }}">
                        @endif
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