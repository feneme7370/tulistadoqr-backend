<x-sistem.modal.dialog-modal wire:model="showDeleteModal">
    <x-slot name="title">
        {{ __('Borrar') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Desea eliminar el registro?') }}
    </x-slot>

    <x-slot name="footer">
        <x-sistem.buttons.normal-btn wire:click="$set('showDeleteModal', false)" wire:loading.attr="disabled" title="Cancelar" />

        <x-sistem.buttons.delete-btn wire:click="deleteMembership()" wire:loading.attr="disabled"
        title="Borrar" />
    </x-slot>
</x-sistem.modal.dialog-modal>