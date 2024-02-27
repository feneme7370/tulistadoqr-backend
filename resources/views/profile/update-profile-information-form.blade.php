<x-sistem.forms.form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informacion del perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la informacion de tu perfil y el email.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-sistem.forms.label-form for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-sistem.buttons.normal-btn class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Seleccionar nueva foto') }}
                </x-sistem.buttons.normal-btn>

                @if ($this->user->profile_photo_path)
                    <x-sistem.buttons.normal-btn type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Eliminar foto') }}
                    </x-sistem.buttons.normal-btn>
                @endif

                <x-sistem.forms.input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
            <x-sistem.forms.input-form id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-sistem.forms.input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
            <x-sistem.forms.input-form id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
            <x-sistem.forms.input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('El email esta sin verificar.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Has click aqui para reenviar la verificacion del email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Se envio la nueva verificacion, revisa tu email.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-sistem.notifications.action-message class="me-3" on="saved">
            {{ __('Guardado.') }}
        </x-sistem.notifications.action-message>

        <x-sistem.buttons.primary-btn type="submit" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-sistem.buttons.primary-btn>
    </x-slot>
</x-sistem.forms.form-section>
