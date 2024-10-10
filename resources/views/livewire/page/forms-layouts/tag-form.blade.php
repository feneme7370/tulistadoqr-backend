{{-- form actions --}}

  <x-pages.modals.jetstream.dialog-modal wire:model="showActionModal">
  <x-slot name="title">
      {{ __('Formulario para ' . ($tag ? 'editar' : 'agregar') . ' datos') }}
  </x-slot>

  <x-slot name="content">

    {{-- form datos --}}
    <x-pages.forms.jetstream.form-section submit="save">
      <x-slot name="title">
        {{ __('Datos') }}
      </x-slot>

      <x-slot name="description">
        {{ __('Etiquetas que se resaltan al ver un producto, como por ejemplo "Nuevo", "Vegano", "Sin TACC", etc.') }}
      </x-slot>

      <x-slot name="form">
        <div class="grid gap-2 w-full">
          <div>
            <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
            <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
            <x-pages.forms.input-error for="name" />
          </div>
        </div>
        <x-pages.spinners.loading-spinner wire:loading.delay />
      </x-slot>

      <x-slot name="actions">
        <x-pages.buttons.normal-btn 
        title="Cancelar" 
        wire:click="$set('showActionModal', false)" 
      >
      </x-pages.buttons.primary-btn>

      <x-pages.buttons.primary-btn 
        title="{{$tag ? 'Actualizar' : 'Guardar'}}" 
        wire:click="save" 
      >
      </x-pages.buttons.primary-btn>


      </x-slot>

    </x-pages.forms.jetstream.form-section>

  </x-slot>

  <x-slot name="footer">
  </x-slot>
  </x-pages.modals.jetstream.dialog-modal>
{{-- form actions --}}