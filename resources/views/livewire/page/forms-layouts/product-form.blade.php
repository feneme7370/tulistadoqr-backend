{{-- modal action --}}
  <x-pages.modals.jetstream.dialog-modal wire:model="showActionModal">
      <x-slot name="title">
          {{ __('Formulario para ' . ($product ? 'editar' : 'agregar') . ' datos') }}
      </x-slot> 
    
      <x-slot name="content">

          {{-- form datos --}}
          <x-pages.forms.jetstream.form-section submit="save">
            <x-slot name="title">
              {{ __('Datos') }}
            </x-slot>
    
            <x-slot name="description">
              {{ __('Edite los datos de cada producto.') }}
            </x-slot>
    
            <x-slot name="form">
              <div class="grid gap-2 w-full">
                  <div>
                      <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                      <x-pages.forms.input-form id="name" type="name"
                          placeholder="{{ __('Nombre') }}" wire:model="name" />
                      <x-pages.forms.input-error for="name" />
                  </div>

                  <div>
                      <x-pages.forms.label-form for="price_original" value="{{ __('Precio original') }}" />
                      <x-pages.forms.input-form id="price_original" type="number"
                          placeholder="{{ __('Precio') }}" wire:model="price_original" />
                      <x-pages.forms.input-error for="price_original" />
                  </div>

                  <div>
                      <x-pages.forms.label-form for="price_seller" value="{{ __('Precio de oferta') }}" />
                      <x-pages.forms.input-form id="price_seller" type="number"
                          placeholder="{{ __('Precio de oferta') }}" wire:model="price_seller" />
                      <x-pages.forms.input-error for="price_seller" />
                  </div>

                  <div>
                      <x-pages.forms.label-form for="cost" value="{{ __('Costo del producto') }}" />
                      <x-pages.forms.input-form id="cost" type="number"
                          placeholder="{{ __('Costo del producto') }}" wire:model="cost" />
                      <x-pages.forms.input-error for="cost" />
                  </div>

                  <div>
                      <x-pages.forms.label-form for="category_id" value="{{ __('Categoria') }}" />
                      <x-pages.forms.select-form wire:model.live="category_id" id="category_id" value_placeholder="-- Seleccionar Categorias --">
                        @foreach ($levels as $level)
                          <optgroup label="{{$level->name}}">
          
                          @foreach ($categories as $category)
                              @if ($category->level->name == $level->name)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endif
                          @endforeach
                          
                          </optgroup>
                        @endforeach
                      </x-pages.forms.select-form>
                      <x-pages.forms.input-error for="category_id" />
                  </div>

                  <div>
                    <x-pages.forms.label-form value="{{ 'Estado' }}">
                      <x-pages.forms.checkbox-form type="checkbox" class="" wire:model="status" />
                    </x-pages.forms.label-form>
                  </div>

                  {{-- <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" /> --}}
                  
              </div>
            </x-slot>
    
            <x-slot name="actions">
            </x-slot>
    
          </x-pages.forms.jetstream.form-section>

          <x-pages.divides.section-border />

          {{-- form descripcion y tags --}}
          <x-pages.forms.jetstream.form-section submit="save">
            <x-slot name="title">
              {{ __('Descripcion') }}
            </x-slot>
    
            <x-slot name="description">
              {{ __('Ponga la descripcion del producto y las etiquetas que quiere asociar.') }}
            </x-slot>
    
            <x-slot name="form">
              <div class="grid gap-2 w-full">
                  
                  <div>
                      <x-pages.forms.label-form value="Etiquetas"/>
                      <div class="grid grid-cols-2 md:grid-cols-3">
                          @foreach ($tags as $item)
                          <div class="flex gap-1 items-center">
                          <x-pages.forms.label-form :for="'product_tags['. $item->id .']'" value="{{ $item->name }}">
                            <x-pages.forms.checkbox-form :value="$item->id" wire:model="product_tags" :id="'product_tags['. $item->id .']'" />
                          </x-pages.forms.label-form>
                          </div>
                          @endforeach
                      </div>
                  </div>

                  <div>
                      <x-pages.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                      <x-pages.forms.textarea-form id="description"
                          placeholder="{{ __('Ingresar una breve descripcion para el 1º parrafo') }}" wire:model="description" />
                      <x-pages.forms.input-error for="description" />
                  </div>

                  <div>
                      <x-pages.forms.label-form for="description2" value="{{ __('Descripcion 2º parrafo') }}" />
                      <x-pages.forms.textarea-form id="description2"
                          placeholder="{{ __('Ingresar una breve descripcion para el 2º parrafo') }}" wire:model="description2" />
                      <x-pages.forms.input-error for="description2" />
                  </div>

                  <div>
                      <x-pages.forms.label-form for="description3" value="{{ __('Descripcion 3º parrafo') }}" />
                      <x-pages.forms.textarea-form id="description3"
                          placeholder="{{ __('Ingresar una breve descripcion para el 3º parrafo') }}" wire:model="description3" />
                      <x-pages.forms.input-error for="description3" />
                  </div>
                  
                  {{-- <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" /> --}}
                  
              </div>
            </x-slot>
    
            <x-slot name="actions">
            </x-slot>
    
          </x-pages.forms.jetstream.form-section>

          <x-pages.divides.section-border />

          {{-- form imagenes --}}
          <x-pages.forms.jetstream.form-section submit="save">
            <x-slot name="title">
              {{ __('Imagenes') }}
            </x-slot>
    
            <x-slot name="description">
              {{ __('Edite la imagen del producto.') }}
            </x-slot>
    
            <x-slot name="form">
              <div class="grid gap-2 w-full">

                  {{-- imagen del producto --}}
                  <x-pages.cards.upload-image 
                    new_image_file="{{$this->image_hero_new}}"
                    new_image_file_string="image_hero_new"
                    rotate="rotateImage"
                    delete="deleteImageEdit"
                    image_file_uri="{{ $this->image_hero_uri }}"
                    image_file_name="{{ $this->image_hero }}"
                    title="Portada"
                    title_2="Imagen de portada"
                  />

                  {{-- imagenes adicionales --}}
                  <div>
                    <x-pages.forms.label-form value="Imagenes de productos"/>
                    <div class="grid md:grid-cols-1">
                      <div>
                        <x-pages.forms.label-form for="product_new_pictures" value="{{ __('Cargar imagenes') }}" />

                        @if ($product)
                          <x-pages.forms.input-file-form id="product_new_pictures" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="product_new_pictures" multiple accept="image/*"
                              />
                          <x-pages.forms.input-error for="product_new_pictures" />
                          <x-pages.forms.input-error for="product_new_pictures.*" />

                          <div class="grid grid-cols-6 gap-2 mb-5">
                            @foreach ($product_new_pictures as $item_new)
                              <x-pages.libraries.lightbox.img-tumb-lightbox class_w_h="h-16 w-16"
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
                              
                              <div class="w-full mx-auto flex justify-between items-center mb-1">
                                      <x-pages.libraries.lightbox.img-tumb-lightbox class_w_h="h-16 w-16"
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

                  {{-- <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" /> --}}
                  
                <x-pages.spinners.loading-spinner wire:loading.delay />

              </div>
            </x-slot>
    
            <x-slot name="actions">
              <x-pages.buttons.normal-btn 
              title="Cancelar" 
              wire:click="$set('showActionModal', false)" 
            >
            </x-pages.buttons.primary-btn>

            <x-pages.buttons.primary-btn 
              title="{{$product ? 'Actualizar' : 'Guardar'}}" 
              wire:click="save" 
            >
            </x-pages.buttons.primary-btn>
            </x-slot>
    
          </x-pages.forms.jetstream.form-section>

      </x-slot>
    
      <x-slot name="footer">
      </x-slot>
  </x-pages.modals.jetstream.dialog-modal>
{{-- end modal action --}}

<x-pages.modals.jetstream.dialog-modal wire:model="showViewModal">
    <x-slot name="title">
        {{ __('Ver datos') }}
    </x-slot> 
  
    <x-slot name="content">
  
      <div class="grid gap-3 p-1">
  
        <picture class="w-full mb-5">
          <x-pages.libraries.lightbox.img-tumb-lightbox class_w_h="h-64 w-64" class="mx-auto" :uri="$product->image_hero_uri ?? ''"
          :name="$product->image_hero ?? ''" />
        </picture>
  
        <p class="text-gray-900 font-bold text-lg mr-3 text-center">{{ $product->name ?? ''}}</p>

        <p class="text-gray-900 font-bold text-base mr-3">Categoria: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->category->name ?? ''}}</span>
        </p>

        <div class="grid grid-cols-3 justify-center items-center gap-1 mx-auto">
          <p class="text-gray-900 font-bold text-base mr-3">Precio: 
            <br><span class="text-gray-700 italic text-sm normal-case">$ {{ number_format(($product->price_original ?? 0), 2,",",".") }}</span>
          </p>
          <p class="text-gray-900 font-bold text-base mr-3">Oferta: 
            <br><span class="text-gray-700 italic text-sm normal-case">$ {{ number_format(($product->price_seller ?? 0), 2,",",".") }}</span>
          </p>
          <p class="text-gray-900 font-bold text-base mr-3">Costo: 
            <br><span class="text-gray-700 italic text-sm normal-case">$ {{ number_format(($product->cost ?? 0), 2,",",".") }}</span>
          </p>
        </div>

        <p class="text-gray-900 font-bold text-base mr-3">Descripcion: 
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $product->description ?? ''}}</span>
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $product->description2 ?? ''}}</span>
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $product->description3 ?? ''}}</span>
        </p>

        <div class="grid grid-cols-2">
          <p class="text-gray-900 font-bold text-base mr-3">Etiquetas: 
            <br>
            @foreach (($product->tags ?? []) as $item)
                
            <span class="text-gray-700 bg-gray-200 p-1 rounded-lg italic mt-2 mr-3 text-sm normal-case">{{ $item->name ?? ''}}</span>
  
            @endforeach
          </p>
  
          <p class="text-gray-900 font-bold text-base mr-3">Estado: 
            <br><span class="text-gray-700 italic text-sm normal-case">{{ ($product->status ?? '') ? 'Activo' : 'Inactivo'}}</span>
          </p>
        </div>
        <p class="text-gray-900 font-bold text-base mr-3">Ultima modificacion por: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->user->lastname ?? ''}}, {{ $product->user->name ?? ''}}</span>
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->company->name ?? ''}}</span>
        </p>
      </div>
  
    </x-slot>
  
    <x-slot name="footer">
    </x-slot>
  </x-pages.modals.jetstream.dialog-modal>