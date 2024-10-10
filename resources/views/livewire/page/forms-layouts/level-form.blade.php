{{-- modal action --}}
  <x-pages.modals.jetstream.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
        {{ __('Formulario para ' . ($level ? 'editar' : 'agregar') . ' datos') }}
    </x-slot> 

    <x-slot name="content">

      {{-- form datos --}}
      <x-pages.forms.jetstream.form-section submit="save">
        <x-slot name="title">
          {{ __('Datos') }}
        </x-slot>

        <x-slot name="description">
          {{ __('Agregue un nombre a la categoria general como "Bebidas", "Comidas", "Postres" o "Menu infantil".') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">

            <div>
              <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
              <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
              <x-pages.forms.input-error for="name" />
            </div>
    
            <div>
              <x-pages.forms.label-form for="description" value="{{ __('Descripcion') }}" />
              <x-pages.forms.textarea-form id="description" placeholder="{{ __('Ingresar una breve descripcion') }}"
                wire:model="description" />
              <x-pages.forms.input-error for="description" />
            </div>

            <div>
              <x-pages.forms.label-form value="{{ 'Estado' }}">
                <x-pages.forms.checkbox-form type="checkbox" class="" wire:model="status" />
              </x-pages.forms.label-form>
            </div>

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
          {{ __('Edite la imagen de la categoria general.') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">
    
            {{-- imagen del nivel --}}
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
            title="{{$level ? 'Actualizar' : 'Guardar'}}" 
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

{{-- modal view --}}
<x-pages.modals.jetstream.dialog-modal wire:model="showViewModal">
  <x-slot name="title">
      {{ __('Ver datos') }}
  </x-slot> 

  <x-slot name="content">

    <div class="grid gap-3 p-1">

      <picture class="w-full mb-5">
        <x-pages.libraries.lightbox.img-tumb-lightbox class_w_h="h-64 w-64" class="mx-auto" :uri="$level->image_hero_uri ?? ''"
        :name="$level->image_hero ?? ''" />
      </picture>

      <p class="text-gray-900 font-bold text-lg uppercase mr-3 text-center">{{ $level->name ?? ''}}</p>

      <p class="text-gray-900 font-bold text-base uppercase mr-3">Descripcion: 
        <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $level->description ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Estado: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ ($level->status ?? '') ? 'Activo' : 'Inactivo'}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Ultima modificacion por: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $level->user->lastname ?? ''}}, {{ $level->user->name ?? ''}}</span>
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $level->company->name ?? ''}}</span>
      </p>
    </div>

  </x-slot>

  <x-slot name="footer">
  </x-slot>
</x-pages.modals.jetstream.dialog-modal>
{{-- end modal view --}}