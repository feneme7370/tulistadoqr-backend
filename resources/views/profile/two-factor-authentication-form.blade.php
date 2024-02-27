<x-sistem.menus.action-section>
    <x-slot name="title">
        {{ __('Autenticacion de doble factor') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Agregue seguridad adicional a su cuenta usando la autenticación de dos factores.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Terminar de habilitar la autenticación de dos factores.') }}
                @else
                    {{ __('Ha habilitado la autenticación de dos factores.') }}
                @endif
            @else
                {{ __('No has habilitado la autenticación de dos factores.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Cuando la autenticacion de dos factores está habilitada, se le solicitara un token aleatorio seguro durante la autenticacion. Puedes recuperar este token desde la aplicacion Google Authenticator de tu telefono.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('Para terminar de habilitar la autenticacion de dos factores, escanee el siguiente codigo QR usando la aplicacion de autenticacion de su telefono o ingrese la clave de configuracion y proporcione el código OTP generado.') }}
                        @else
                            {{ __('La autenticacion de dos factores ahora esta habilitada. Escanee el siguiente codigo QR usando la aplicacion de autenticacion de su telefono o ingrese la clave de configuracion.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Clave de configuracion') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-sistem.forms.label-form for="code" value="{{ __('Code') }}" />

                        <x-sistem.forms.input-form id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-sistem.forms.input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Guarde estos codigos de recuperacion en un administrador de claves seguro. Se pueden utilizar para recuperar el acceso a su cuenta si pierde su dispositivo de autenticacion de dos factores.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-sistem.forms.confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-sistem.buttons.primary-btn type="button" wire:loading.attr="disabled">
                        {{ __('Permitir') }}
                    </x-sistem.buttons.primary-btn>
                </x-sistem.forms.confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-sistem.forms.confirms-password wire:then="regenerateRecoveryCodes">
                        <x-sistem.buttons.normal-btn class="me-3">
                            {{ __('Regenerar codigos de recuperacion') }}
                        </x-sistem.buttons.normal-btn>
                    </x-sistem.forms.confirms-password>
                @elseif ($showingConfirmation)
                    <x-sistem.forms.confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-sistem.buttons.primary-btn type="button" class="me-3" wire:loading.attr="disabled">
                            {{ __('Confirmar') }}
                        </x-sistem.buttons.primary-btn>
                    </x-sistem.forms.confirms-password>
                @else
                    <x-sistem.forms.confirms-password wire:then="showRecoveryCodes">
                        <x-sistem.buttons.normal-btn class="me-3">
                            {{ __('Mostrar codigos de recuperacion') }}
                        </x-sistem.buttons.normal-btn>
                    </x-sistem.forms.confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-sistem.forms.confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-sistem.buttons.normal-btn wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-sistem.buttons.normal-btn>
                    </x-sistem.forms.confirms-password>
                @else
                    <x-sistem.forms.confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-sistem.buttons.danger-btn wire:loading.attr="disabled">
                            {{ __('Desactivar') }}
                        </x-sistem.buttons.danger-btn>
                    </x-sistem.forms.confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-sistem.menus.action-section>
