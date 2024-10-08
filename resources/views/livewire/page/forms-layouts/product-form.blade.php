<x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
        {{ __('Formulario para ' . ($product ? 'editar' : 'agregar') . ' datos') }}
    </x-slot> 
  
    <x-slot name="content">

        {{-- form datos --}}
        <x-sistem.forms.form-section submit="save">
          <x-slot name="title">
            {{ __('Datos') }}
          </x-slot>
  
          <x-slot name="description">
            {{ __('Edite los datos de cada producto.') }}
          </x-slot>
  
          <x-slot name="form">
            <div class="grid gap-2 w-full">
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
                    <x-sistem.forms.label-form for="cost" value="{{ __('Costo del producto') }}" />
                    <x-sistem.forms.input-form id="cost" type="number"
                        placeholder="{{ __('Costo del producto') }}" wire:model="cost" />
                    <x-sistem.forms.input-error for="cost" />
                </div>

                <div>
                    <x-sistem.forms.label-form for="category_id" value="{{ __('Categoria') }}" />
                    <x-sistem.forms.select-form wire:model="category_id" id="category_id">
                      @foreach ($levels as $level)
                      <optgroup label="{{$level->name}}">
      
                        @foreach ($categories as $category)
                          @if ($category->level->name == $level->name)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                          @endif
                        @endforeach
                        
                      </optgroup>
                    @endforeach
                    </x-sistem.forms.select-form>
                    <x-sistem.forms.input-error for="category_id" />
                </div>

                <div>
                    <label for="status" class="flex items-center">
                        <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                    </label>
                </div>

                <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" />
                
            </div>
          </x-slot>
  
          <x-slot name="actions">
          </x-slot>
  
        </x-sistem.forms.form-section>

        <x-sistem.menus.section-border />

        {{-- form descripcion y tags --}}
        <x-sistem.forms.form-section submit="save">
          <x-slot name="title">
            {{ __('Descripcion') }}
          </x-slot>
  
          <x-slot name="description">
            {{ __('Ponga la descripcion del producto y las etiquetas que quiere asociar.') }}
          </x-slot>
  
          <x-slot name="form">
            <div class="grid gap-2 w-full">
                
                <div>
                    <x-sistem.forms.label-form value="Etiquetas"/>
                    <div class="grid md:grid-cols-2">
                        @foreach ($tags as $item)
                        <div class="flex gap-1 items-center">
                            <x-sistem.forms.label-form :for="'product_tags['. $item->id .']'" :value="$item->name">
                            <x-sistem.forms.checkbox-form :value="$item->id" wire:model="product_tags" :id="'product_tags['. $item->id .']'"/>
                            </x-sistem.forms.label-form >
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                    <x-sistem.forms.textarea-form id="description"
                        placeholder="{{ __('Ingresar una breve descripcion para el 1º parrafo') }}" wire:model="description" />
                    <x-sistem.forms.input-error for="description" />
                </div>

                <div>
                    <x-sistem.forms.label-form for="description2" value="{{ __('Descripcion 2º parrafo') }}" />
                    <x-sistem.forms.textarea-form id="description2"
                        placeholder="{{ __('Ingresar una breve descripcion para el 2º parrafo') }}" wire:model="description2" />
                    <x-sistem.forms.input-error for="description2" />
                </div>

                <div>
                    <x-sistem.forms.label-form for="description3" value="{{ __('Descripcion 3º parrafo') }}" />
                    <x-sistem.forms.textarea-form id="description3"
                        placeholder="{{ __('Ingresar una breve descripcion para el 3º parrafo') }}" wire:model="description3" />
                    <x-sistem.forms.input-error for="description3" />
                </div>
                
                <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" />
                
            </div>
          </x-slot>
  
          <x-slot name="actions">
          </x-slot>
  
        </x-sistem.forms.form-section>

        <x-sistem.menus.section-border />

        {{-- form imagenes --}}
        <x-sistem.forms.form-section submit="save">
          <x-slot name="title">
            {{ __('Imagenes') }}
          </x-slot>
  
          <x-slot name="description">
            {{ __('Edite la imagen del producto.') }}
          </x-slot>
  
          <x-slot name="form">
            <div class="grid gap-2 w-full">

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
            
                            <p class="mb-1">Imagen del producto nueva:</p>
                                <x-sistem.lightbox.img-lightbox 
                                    class="h-64 max-w-96 p-1 bg-gray-200"
                                    :name="$image_hero_new->temporaryUrl()"    
                                />
                        </div>
                        @else
                        <div class="">
                            <p class="mb-1">Imagen del producto actual:</p>
                            <div class="w-64 h-64 mx-auto relative">
                                    <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                                        <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                                    </button>
                                    
                                    <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                        <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                                    </button>
                                <x-sistem.lightbox.img-lightbox 
                                    class="h-64 max-w-96 p-1 bg-gray-200"
                                    :uri="$this->image_hero_uri" 
                                    :name="$this->image_hero"    
                                />
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- imagenes adicionales --}}
                <div>
                  <x-sistem.forms.label-form value="Imagenes de productos"/>
                  <div class="grid md:grid-cols-1">
                    <div>
                      <x-sistem.forms.label-form for="product_new_pictures" value="{{ __('Cargar imagenes') }}" />

                      @if ($product)
                        <x-sistem.forms.input-file-form id="product_new_pictures" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="product_new_pictures" multiple accept="image/*"
                            />
                        <x-sistem.forms.input-error for="product_new_pictures" />
                        <x-sistem.forms.input-error for="product_new_pictures.*" />

                        <div class="grid grid-cols-6 gap-2 mb-5">
                          @foreach ($product_new_pictures as $item_new)
                            <x-sistem.lightbox.img-lightbox 
                                class="h-16 w-16 p-1 "
                                :name="$item_new->temporaryUrl()"    
                            />
                          @endforeach
                        </div>
                        
                      @else
                        <p class="mt-3">Cree el producto solo con la portada y luego entre a editarlo para poder agregarle mas imagenes</p>
                      @endif
                  </div>
                  </div>

                  <div>
                    @if ($product)
                      
                    @foreach ($product->pictures as $item)
                        <div class="flex gap-1 items-center">
                            
                            <div class="w-full mx-auto flex justify-between items-center">
                                    <x-sistem.lightbox.img-lightbox 
                                        class="w-16 h-16 p-1 bg-gray-200"
                                        :uri="$item->route" 
                                        :name="$item->name"    
                                    />
                                    <div>

                                      <button wire:click='rotateProductPicture({{ $item->id }})' type="button" class="p-1 bg-gray-100 rounded-lg text-sm text-gray-600">
                                        <x-sistem.icons.for-icons-app icon="rotate" class="h-2 w-2"/>
                                      </button>
                                      <button wire:click='deleteProductPicture({{ $item->id }})' type="button" class="p-1 bg-red-600 rounded-lg text-sm text-white">
                                          <x-sistem.icons.for-icons-app icon="trash" class="h-2 w-2"/>
                                      </button>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                  </div>

              </div>

                <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" />
                
                <div wire:loading class="mx-auto">
                    <x-sistem.spinners.loading-spinner/>
                </div>

            </div>
          </x-slot>
  
          <x-slot name="actions">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
            title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
              title="{{$product ? 'Actualizar' : 'Guardar'}}">
              <div wire:loading>
                <x-sistem.spinners.loading-spinner-btn />
              </div>
            </x-sistem.buttons.primary-btn>
          </x-slot>
  
        </x-sistem.forms.form-section>

    </x-slot>
  
    <x-slot name="footer">
    </x-slot>
</x-sistem.modal.dialog-modal>

<x-sistem.modal.dialog-modal wire:model="showViewModal">
    <x-slot name="title">
        {{ __('Ver datos') }}
    </x-slot> 
  
    <x-slot name="content">
  
      <div class="grid gap-3 p-1">
  
        <picture class="w-full mb-5">
          <x-sistem.lightbox.img-lightbox class="mx-auto h-auto max-w-96 rounded-lg overflow-hidden" :uri="$product->image_hero_uri ?? ''"
          :name="$product->image_hero ?? ''" />
        </picture>
  
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Nombre: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->name ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Slug: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->slug ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Precio: 
          <br><span class="text-gray-700 italic text-sm normal-case">$ {{ number_format(($product->price_original ?? 0), 2,",",".") }}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Oferta: 
          <br><span class="text-gray-700 italic text-sm normal-case">$ {{ number_format(($product->price_seller ?? 0), 2,",",".") }}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Costo: 
          <br><span class="text-gray-700 italic text-sm normal-case">$ {{ number_format(($product->cost ?? 0), 2,",",".") }}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Descripcion: 
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $product->description ?? ''}}</span>
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $product->description2 ?? ''}}</span>
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $product->description3 ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Categoria: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->category->name ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Etiquetas: 
          <br>
          @foreach (($product->tags ?? []) as $item)
              
          <span class="text-gray-700 bg-gray-200 p-1 rounded-lg italic mt-2 mr-3 text-sm normal-case">{{ $item->name ?? ''}}</span>

          @endforeach
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Estado: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ ($product->status ?? '') ? 'Activo' : 'Inactivo'}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Ultima modificacion por: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->user->lastname ?? ''}}, {{ $product->user->name ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Empresa: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->company->name ?? ''}}</span>
        </p>
      </div>
  
    </x-slot>
  
    <x-slot name="footer">
    </x-slot>
  </x-sistem.modal.dialog-modal>