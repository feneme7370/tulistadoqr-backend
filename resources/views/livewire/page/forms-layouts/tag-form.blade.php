<x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
      {{$tag ? 'Editar' : 'Agregar'}}
    </x-slot>

    <x-slot name="content">

      <form class="grid gap-2 mt-2">

        <div>
          <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
          <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
          <x-sistem.forms.input-error for="name" />
        </div>

      </form>

    </x-slot>

    <x-slot name="footer">
      <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
      <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled"
        title="{{$tag ? 'Actualizar' : 'Guardar'}}" />
    </x-slot>
  </x-sistem.modal.dialog-modal>