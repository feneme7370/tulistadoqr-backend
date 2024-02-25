<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Productos">
        <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
            @slot('icon')
            <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Agregue los productos que ofrece en su menu, puede agregar un precio de oferta, una imagen y si quiere una descripcion que quiera que el cliente vea del producto.</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    {{-- <div class="flex flex-row flex-1 justify-evenly items-center gap-2 p-2"> --}}
    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div  class="w-full">
            <x-sistem.forms.label-form for="categorySearch" value="{{ __('Categoria') }}" />
            <x-sistem.forms.select-form wire:model.live="categorySearch" id="categorySearch">
                <option value=""> Todos </option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->level->name}} - {{$category->name}}</option>
                @endforeach
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="categorySearch" />
        </div>

        <div  class="w-1/4">
            <x-sistem.forms.label-form for="perPage" value="{{ __('Mostrar') }}" />
            <x-sistem.forms.select-form wire:model.live="perPage" id="perPage">
                <option value="10"> 10 </option>
                <option value="30"> 30 </option>
                <option value="50"> 50 </option>
                <option value="100"> 100 </option>
            </x-sistem.forms.select-form>
        </div>
    </x-sistem.filter.bg-input>

    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div class="w-full">
            <x-sistem.forms.input-form 
                wire:model.live.debounce.600ms="search" 
                type="search" 
                placeholder="Buscar por nombre o categoria" 
                class="w-full" />
        </div>
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="active" />Solo activos
        </div>
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="offers" />En oferta
        </div>
    </x-sistem.filter.bg-input>

    {{-- </div> --}}

    {{-- <x-sistem.filter.search-active placeholder="Buscar por nombre, nivel o categoria" /> --}}

    <x-sistem.spinners.loading-spinner wire:loading wire:target="search, level_search, categorySearch"/>

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
                            <th>Productos</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Tags</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $item)
                        <tr>
                            
                            <td class="with-id-columns"><p>{{$item->id}}</p></td>
                            
                            <td class="with-actions-columns">
                                <div class="actions">
                                    <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                                        wire:loading.attr="disabled" />
                                    <x-sistem.buttons.delete-text wire:click="$dispatch('deleteProduct', {{$item->id}})"
                                        wire:loading.attr="disabled" />
                                </div>
                            </td>

                            <td class="with-image-columns">
                                <x-sistem.lightbox.img-tumb-lightbox 
                                    :uri="$item->image_hero_uri" 
                                    :name="$item->image_hero"    
                                />
                              </td>

                            <td class="text-center"><p>{{$item->name}}</p></td>
                            
                            <td 
                                class="text-center"                                
                            ><p class="{{$item->price_seller ? 'text-green-800 font-bold' : 'text-orange-800'}}" >${{$item->price_seller ? number_format($item->price_seller, 2,",",".") : number_format($item->price_original, 2,",",".") }}</p>
                            </td>
                            
                            <td class="text-center"><p>{{$item->category->level->name}} / {{$item->category->name}}</p></td>
                            
                            <td class="text-center"><p>{{$item->tags->count()}}</p></td>

                            <td class="with-status-columns">
                                <span class="line-clamp-2 {{$item->status == '1' ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded' : 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded'}}">
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
        {{ $products->onEachSide(1)->links() }}
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
                title="Borrar" />
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
                            placeholder="{{ __('Nombre') }}" wire:model="name" />
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
                        <x-sistem.forms.label-form for="category_id" value="{{ __('Categoria') }}" />
                        <x-sistem.forms.select-form wire:model="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->level->name}} - {{$category->name}}</option>
                            @endforeach
                        </x-sistem.forms.select-form>
                        <x-sistem.forms.input-error for="category_id" />
                    </div>

                    
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

                <div>
                    <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                    <x-sistem.forms.textarea-form id="description"
                        placeholder="{{ __('Ingresar una breve descripcion') }}" wire:model="description" />
                    <x-sistem.forms.input-error for="description" />
                </div>
                <div>
                    <label for="status" class="flex items-center">
                        <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                    </label>
                </div>


                {{-- imagen del producto --}}
                <div class="bg-gray-100 p-1 rounded-md">
                    <h2 class="text-center text-gray-90 font-bold text-xl">Imagen del producto</h2>
            
                    <div>
                        <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen del producto') }}" />
                        <x-sistem.forms.input-file-form id="image_hero_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_hero_new" accept="image/*"
                            />
                        <x-sistem.forms.input-error for="image_hero_new" />
                    </div>
            
                    <div class="flex justify-center items-center">
        
                        @if ($image_hero_new)
                          <div class="">
              
                              <div wire:loading wire:target="image_hero_new">
                                  <x-sistem.spinners.loading-spinner/>
                              </div>
              
                              <p class="mb-1">Imagen del producto nueva:</p>
                                  <x-sistem.lightbox.img-lightbox 
                                      class="h-64 max-w-96 p-1 bg-primary-200"
                                      :name="$image_hero_new->temporaryUrl()"    
                                  />
                          </div>
                        @else
                          <div class="">
                              <div wire:loading wire:target="image_hero_new">
                                  <x-sistem.spinners.loading-spinner/>
                              </div>
                              <p class="mb-1">Imagen del producto actual:</p>
                              <div class="w-64 h-64 mx-auto relative">
                                    <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                                        <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                                    </button>
                                    
                                    <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                        <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                                    </button>
                                <x-sistem.lightbox.img-lightbox 
                                    class="h-64 max-w-96 p-1 bg-primary-200"
                                    :uri="$this->image_hero_uri" 
                                    :name="$this->image_hero"    
                                />
                              </div>
                          </div>
                        @endif
                      </div>
                  </div>

                <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" />
                <div wire:loading class="mx-auto">
                    <x-sistem.spinners.loading-spinner/>
                </div>
            </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
                title="Cancelar" />

            <x-sistem.buttons.primary-btn 
                wire:click="save"
                wire:loading.class="opacity-50"  
                wire:loading.attr="disabled"
                title="{{$product ? 'Actualizar' : 'Guardar'}}" >
                <div wire:loading>
                    <x-sistem.spinners.loading-spinner-btn/>
                </div>
            </x-sistem.buttons.primary-btn> 
        </x-slot>
    </x-sistem.modal.dialog-modal>

    @push('scripts')
    <script>
          document.addEventListener('livewire:init', () => {
            Livewire.on('deleteProduct', (event) => {
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
                    Livewire.dispatch('deleteProductId', {id : event})
                    }
            })
          });
      })
    </script>

    <script>
        Livewire.on('toastifyProduct', (mensaje) => {
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