<x-guest-layout>
    <x-sistem.menus.authentication-card>
        <x-slot name="logo">
            <x-sistem.menus.application-logo />
        </x-slot>

        <x-sistem.forms.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-sistem.forms.label-form for="mastercode" value="{{ __('Mastercode') }}" />
                <x-sistem.forms.input-form id="mastercode" class="block mt-1 w-full" type="text" name="mastercode" required />
            </div>

            <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
                <x-sistem.forms.input-form id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div>
                <x-sistem.forms.label-form for="company_id" value="{{ __('Empresa') }}" />
                <x-sistem.forms.select-form name="company_id">
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->id}} - {{$company->name}}</option>
                    @endforeach
                </x-sistem.forms.select-form>
                <x-sistem.forms.input-error for="company_id" />
            </div>

            <div class="mt-4">
                <x-sistem.forms.label-form for="password" value="{{ __('Clave') }}" />
                <x-sistem.forms.input-form id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-sistem.forms.label-form for="password_confirmation" value="{{ __('Confirmar clave') }}" />
                <x-sistem.forms.input-form id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-sistem.forms.label-form for="terms">
                        <div class="flex items-center">
                            <x-sistem.forms.checkbox-form name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-sistem.forms.label-form>
                </div>
            @endif --}}

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Ya esta registrado?') }}
                </a>

                <x-sistem.buttons.primary-btn type="submit" class="ms-4">
                    {{ __('Registrar') }}
                </x-sistem.buttons.primary-btn>
            </div>
        </form>
    </x-sistem.menus.authentication-card>
</x-guest-layout>
