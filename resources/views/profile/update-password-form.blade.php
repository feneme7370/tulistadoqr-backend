<x-sistem.forms.form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Actualizar clave') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Asegurese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-sistem.forms.label-form for="current_password" value="{{ __('Clave actual') }}" />
            <x-sistem.forms.input-form id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-sistem.forms.input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-sistem.forms.label-form for="password" value="{{ __('Nueva clave') }}" />
            <x-sistem.forms.input-form id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-sistem.forms.input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-sistem.forms.label-form for="password_confirmation" value="{{ __('Confirmar nueva clave') }}" />
            <x-sistem.forms.input-form id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-sistem.forms.input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-sistem.notifications.action-message class="me-3" on="saved">
            {{ __('Guardado.') }}
        </x-sistem.notifications.action-message>

        <x-sistem.buttons.primary-btn type="submit">
            {{ __('Guardar') }}
        </x-sistem.buttons.primary-btn>
    </x-slot>
</x-sistem.forms.form-section>
