<x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
      {{ __($user ? 'Editar' : 'Agregar') }}
    </x-slot>

    <x-slot name="content">

        <form class="grid gap-2 mt-2">

          <x-sistem.forms.validation-errors class="mb-4" />
          
          <div>
            <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
            <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
               />
            <x-sistem.forms.input-error for="name" />
          </div>

          <div>
            <x-sistem.forms.label-form for="lastname" value="{{ __('Apellido') }}" />
            <x-sistem.forms.input-form id="lastname" type="text" placeholder="{{ __('Apellido') }}" wire:model="lastname"
               />
            <x-sistem.forms.input-error for="lastname" />
          </div>
            
          <div>
            <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
            <x-sistem.forms.input-form id="email" type="email" placeholder="{{ __('Email') }}" wire:model="email"
                 />
            <x-sistem.forms.input-error for="email" />
          </div>
            
          <div>
            <x-sistem.forms.label-form for="phone" value="{{ __('Telefono') }}" />
            <x-sistem.forms.input-form id="phone" type="text" placeholder="{{ __('Telefono') }}" wire:model="phone"
                 />
            <x-sistem.forms.input-error for="phone" />
          </div>
            
          <div>
            <x-sistem.forms.label-form for="adress" value="{{ __('Direccion') }}" />
            <x-sistem.forms.input-form id="adress" type="text" placeholder="{{ __('Direccion') }}" wire:model="adress"
                 />
            <x-sistem.forms.input-error for="adress" />
          </div>
            
          <div>
            <x-sistem.forms.label-form for="birthday" value="{{ __('Fecha de nacimiento') }}" />
            <x-sistem.forms.input-form id="birthday" type="date" placeholder="{{ __('Fecha de nacimiento') }}" wire:model="birthday"
                 />
            <x-sistem.forms.input-error for="birthday" />
          </div>
            
          <div>
            <x-sistem.forms.label-form for="city" value="{{ __('Localidad') }}" />
            <x-sistem.forms.input-form id="city" type="text" placeholder="{{ __('Localidad') }}" wire:model="city"
                 />
            <x-sistem.forms.input-error for="city" />
          </div>

          {{-- <div>
            <x-sistem.forms.label-form for="social" value="{{ __('Redes sociales') }}" />
            <x-sistem.forms.input-form id="social" type="text" placeholder="{{ __('Redes Sociales') }}" wire:model="social"
                 />
            <x-sistem.forms.input-error for="social" />
          </div> --}}

          <div>
            <x-sistem.forms.label-form for="company_id" value="{{ __('Empresa') }}" />
            <x-sistem.forms.select-form wire:model="company_id">
                @foreach ($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="company_id" />
          </div>
            
          <div>
            <x-sistem.forms.label-form for="description" value="{{ __('Descripcion del usuario') }}" />
            <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Descripcion') }}"
                wire:model="description" />
            <x-sistem.forms.input-error for="description" />
          </div>

          <div>
            <label for="status" class="flex items-center">
                <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
            </label>
          </div>

          <div>
            <x-sistem.forms.label-form for="password" value="{{ __('Clave') }}" />
            <x-sistem.forms.input-form id="password" type="password" placeholder="{{ __('Clave') }}" wire:model="password"
                 />
            <x-sistem.forms.input-error for="password" />
          </div>

          <div>
            <x-sistem.forms.label-form for="password_confirmation" value="{{ __('Repetir clave') }}" />
            <x-sistem.forms.input-form id="password_confirmation" type="password" placeholder="{{ __('Repetir clave') }}" wire:model="password_confirmation"
                 />
            <x-sistem.forms.input-error for="password_confirmation" />
          </div>

        </form>

    </x-slot>

    <x-slot name="footer">
        <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
        <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{$user ? 'Actualizar' : 'Guardar'}}"  />
    </x-slot>
</x-sistem.modal.dialog-modal>