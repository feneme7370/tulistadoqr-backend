<x-sistem.modal.dialog-modal wire:model="showActionModal">
  <x-slot name="title">
      {{ __('Formulario para ' . ($role ? 'editar' : 'agregar') . ' datos') }}
  </x-slot>

  <x-slot name="content">
      <x-sistem.forms.form-section submit="save">
        <x-slot name="title">
          {{ __('Datos') }}
        </x-slot>

        <x-slot name="description">
          {{ __('Agregar el nombre del rol y poner web en guard name.') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">
            <div>
              <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
              <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
              <x-sistem.forms.input-error for="name" />
            </div>
    
            <div>
              <x-sistem.forms.label-form for="guard_name" value="{{ __('Guard Name') }}" />
              <x-sistem.forms.input-form id="guard_name" type="text" placeholder="{{ __('Guard Name') }}" wire:model="guard_name" />
              <x-sistem.forms.input-error for="guard_name" />
            </div>

          </div>
        </x-slot>

        <x-slot name="actions">
        </x-slot>

      </x-sistem.forms.form-section>

      <x-sistem.menus.section-border />

      <x-sistem.forms.form-section submit="save">
        <x-slot name="title">
          {{ __('Permisos') }}
        </x-slot>

        <x-slot name="description">
          {{ __('Seleccione los permisos que el rol va a tener.') }}
        </x-slot>

        <x-slot name="form">
          <div class="grid gap-2 w-full">

            <div>
              <x-sistem.forms.label-form value="Permisos"/>
              <div class="grid md:grid-cols-2">
                  @foreach ($permissions as $item)
                  <div class="flex gap-1 items-center">
                      <x-sistem.forms.label-form :for="'role_permissions['. $item->id .']'" :value="$item->name">
                      <x-sistem.forms.checkbox-form :value="$item->id" wire:model="role_permissions" :id="'role_permissions['. $item->id .']'"/>
                      </x-sistem.forms.label-form >
                  </div>
                  @endforeach
              </div>
          </div>

          </div>
        </x-slot>

        <x-slot name="actions">
          <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
          title="Cancelar" />
          <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
            title="{{$role ? 'Actualizar' : 'Guardar'}}">
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