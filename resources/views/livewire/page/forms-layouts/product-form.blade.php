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
                    <x-sistem.forms.label-form for="category_id" value="{{ __('Categoria') }}" />
                    <x-sistem.forms.select-form wire:model="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->level->name}} - {{$category->name}}</option>
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
                        placeholder="{{ __('Ingresar una breve descripcion') }}" wire:model="description" />
                    <x-sistem.forms.input-error for="description" />
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
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Descripcion: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $product->description ?? ''}}</span>
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