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