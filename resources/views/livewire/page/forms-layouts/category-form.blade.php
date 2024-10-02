<x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
        {{ __('Formulario para ' . ($category ? 'editar' : 'agregar') . ' datos') }}
    </x-slot> 

    <x-slot name="content">

      {{-- form datos --}}
      <x-sistem.forms.form-section submit="save">
        <x-slot name="title">
          {{ __('Datos') }}
        </x-slot>

        <x-slot name="description">
          {{ __('Agregue categorias especificas como "Pizzas", "Helados", "Cervezas" o "Caffes". Los que se agreguen se podran asociar a un producto y luego poder ser filtrados en la pagina por cada rubro.') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">

            <div>
              <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
              <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    />
              <x-sistem.forms.input-error for="name" />
            </div>
  
            <div>
              <x-sistem.forms.label-form for="level_id" value="{{ __('Categoria General') }}" />
              <x-sistem.forms.select-form wire:model="level_id" id="level_id">
                  @foreach ($levels as $level)
                      <option value="{{$level->id}}">{{$level->name}}</option>
                  @endforeach
              </x-sistem.forms.select-form>
              <x-sistem.forms.input-error for="level_id" />
            </div>
              
            <div>
              <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
              <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingresar una breve descripcion') }}"
                  wire:model="description" />
              <x-sistem.forms.input-error for="description" />
            </div>

            {{-- <div wire:ignore>
              <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
              <x-sistem.forms.textarea-summernote-form id="summernote-description" placeholder="{{ __('Ingresar una breve descripcion') }}"
              wire:model="description"/>
              <textarea id="description" wire:model="description"></textarea>
              <x-sistem.forms.input-error for="description" />
            </div> --}}

            <div>
              <label for="status" class="flex items-center">
                  <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                  <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
              </label>
            </div>

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
          {{ __('Edite la imagen de la categoria.') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">
  
            {{-- imagen de categoria --}}
            <div class="bg-gray-100 p-1 rounded-md">
              <h2 class="text-center text-gray-900 font-bold text-xl">Imagen de categoria</h2>
      
              <div>
                  <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen de categoria') }}" />
                  <x-sistem.forms.input-file-form id="image_hero_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_hero_new" accept="image/*"
                      />
                  <x-sistem.forms.input-error for="image_hero_new" />
              </div>
      
              <div class="flex justify-center items-center">
      
                @if ($image_hero_new)
                  <div class="">
      
                      <p class="mb-1">Imagen de categoria nueva:</p>
                          <x-sistem.lightbox.img-lightbox 
                              class="h-64 max-w-96 p-1"
                              :name="$image_hero_new->temporaryUrl()"    
                          />
                  </div>
                @else
                  <div class="">
                      <p class="mb-1">Imagen de categoria actual:</p>
                      <div class="w-64 h-64 mx-auto relative">
  
                        <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                            <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                        </button>
                        
                        <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                            <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                        </button>
                        
                        <x-sistem.lightbox.img-lightbox 
                            class="h-64 max-w-96 p-1"
                            :uri="$this->image_hero_uri" 
                            :name="$this->image_hero"    
                        />
                      </div>
                  </div>
                @endif
              </div>
              
            </div>
  
            <div wire:loading class="mx-auto">
              <x-sistem.spinners.loading-spinner/>
            </div>

          </div>
        </x-slot>

        <x-slot name="actions">
          <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
          <x-sistem.buttons.primary-btn 
            type="submit"
            wire:loading.class="opacity-50" 
            wire:loading.attr="disabled"
            title="{{$category ? 'Actualizar' : 'Guardar'}}" >
              <div wire:loading>
                  <x-sistem.spinners.loading-spinner-btn/>
              </div>
          </x-sistem.buttons.primary-btn> 
        </x-slot>

      </x-sistem.forms.form-section>

    </x-slot>

    <x-slot name="footer">
    </x-slot>
</x-sistem.modal.dialog-modal>

@push('scripts')
  <script>
    // document.addEventListener('livewire:load', () => {
      // Runs after Livewire is loaded but before it's initialized
      // on the page...
      // $(function(){
      //   $('#description').summernote({
      //     placeholder: 'Hello stand alone ui',
      //     tabsize: 2,
      //     height: 120,
      //     toolbar: [
      //       ['style', ['style']],
      //       ['font', ['bold', 'underline', 'clear']],
      //       ['color', ['color']],
      //       ['para', ['ul', 'ol', 'paragraph']],
      //       ['insert', ['link']],
      //     ],
      //     callbacks: {
      //       onChange: function(contents, $editable) {
      //         // console.log('onChange:', contents, $editable);
      //         @this.set('description', contents)
      //       },
      //     }
      //     })
      //   });
    // })
  </script>
@endpush

<x-sistem.modal.dialog-modal wire:model="showViewModal">
    <x-slot name="title">
        {{ __('Ver datos') }}
    </x-slot> 

    <x-slot name="content">

      <div class="grid gap-3 p-1">

        <picture class="w-full mb-5">
          <x-sistem.lightbox.img-lightbox class="mx-auto h-auto max-w-96 rounded-lg overflow-hidden" :uri="$category->image_hero_uri ?? ''"
          :name="$category->image_hero ?? ''" />
        </picture>
  
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Nombre: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $category->name ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Slug: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $category->slug ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Descripcion: 
          <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $category->description ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Estado: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ ($category->status ?? '') ? 'Activo' : 'Inactivo'}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Categoria General: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $category->level->name ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Ultima modificacion por: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $category->user->lastname ?? ''}}, {{ $category->user->name ?? ''}}</span>
        </p>
        <p class="text-gray-900 font-bold text-base uppercase mr-3">Empresa: 
          <br><span class="text-gray-700 italic text-sm normal-case">{{ $category->company->name ?? ''}}</span>
        </p>
      </div>

    </x-slot>

    <x-slot name="footer">
    </x-slot>
</x-sistem.modal.dialog-modal>