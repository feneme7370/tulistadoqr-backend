<x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
      {{ __($role ? 'Editar' : 'Agregar') }}
    </x-slot>

    <x-slot name="content">
      <form class="grid gap-2 mt-2">

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

        @foreach ($permissions as $item)
        <div class="flex gap-1 items-center">
            <x-sistem.forms.checkbox-form :value="$item->id" wire:model="role_permissions" id="role_permissions"/>
            <x-sistem.forms.label-form for="role_permissions" :value="$item->name"/>
        </div>
        @endforeach
      </form>

    </x-slot>

    <x-slot name="footer">
      <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
      <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
        title="{{$role ? 'Actualizar' : 'Guardar'}}">
        <div wire:loading>
          <x-sistem.spinners.loading-spinner-btn />
        </div>
      </x-sistem.buttons.primary-btn>
    </x-slot>
  </x-sistem.modal.dialog-modal>