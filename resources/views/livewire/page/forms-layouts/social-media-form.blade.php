<x-sistem.modal.dialog-modal wire:model="showActionModal">
  <x-slot name="title">
      {{ __('Formulario para ' . ($social_media ? 'editar' : 'agregar') . ' datos') }}
  </x-slot>

  <x-slot name="content">
      <x-sistem.forms.form-section submit="save">
        <x-slot name="title">
          {{ __($social_media ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="description">
          {{ __('Cree las redes sociales que van a poder utilizar los usuarios para agregarles sus datos.') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">
            <div>
              <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
              <x-sistem.forms.input-form id="name" name="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                   />
              <x-sistem.forms.input-error for="name" />
            </div>
          </div>
        </x-slot>

        <x-slot name="actions">
          <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
          title="Cancelar" />
          <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
            title="{{$social_media ? 'Actualizar' : 'Guardar'}}">
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