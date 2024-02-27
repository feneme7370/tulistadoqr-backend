<x-sistem.menus.action-section>
    <x-slot name="title">
        {{ __('Eliminar cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Puede eliminar su cuenta de forma definitiva.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminaran permanentemente. Antes de eliminar su cuenta, descargue cualquier dato o informacion que desee conservar.') }}
        </div>

        <div class="mt-5">
            <x-sistem.buttons.danger-btn wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Eliminar cuenta') }}
            </x-sistem.buttons.danger-btn>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-sistem.modal.dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Eliminar cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Estas seguro de que quieres eliminar tu cuenta? Una vez que se elimine su cuenta, todos sus recursos y datos se eliminaran permanentemente. Ingrese su clave para confirmar que desea eliminar permanentemente su cuenta.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-sistem.forms.input-form type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Clave') }}"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="deleteUser" />

                    <x-sistem.forms.input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-sistem.buttons.normal-btn wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-sistem.buttons.normal-btn>

                <x-sistem.buttons.danger-btn class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                   -{{ __('Eliminar cuenta') }}
                </x-sistem.buttons.danger-btn>
            </x-slot>
        </x-sistem.modal.dialog-modal>
    </x-slot>
</x-sistem.menus.action-section>
