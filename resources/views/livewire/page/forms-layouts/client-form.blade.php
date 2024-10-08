<x-sistem.modal.dialog-modal wire:model="showActionModal">
  <x-slot name="title">
      {{ __('Formulario para ' . ($client ? 'editar' : 'agregar') . ' datos') }}
  </x-slot> 

  <x-slot name="content">

    {{-- form datos --}}
    <x-sistem.forms.form-section submit="save">
      <x-slot name="title">
        {{ __('Datos') }}
      </x-slot>

      <x-slot name="description">
        {{ __('Agregue los datos del cliente.') }}
      </x-slot>

      <x-slot name="form">
        <div class="grid gap-2 w-full">

          <div>
            <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
            <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
            <x-sistem.forms.input-error for="name" />
          </div>

          <div>
            <x-sistem.forms.label-form for="lastname" value="{{ __('Apellido') }}" />
            <x-sistem.forms.input-form id="lastname" type="text" placeholder="{{ __('Apellido') }}" wire:model="lastname" />
            <x-sistem.forms.input-error for="lastname" />
          </div>

          <div>
            <x-sistem.forms.label-form for="email" value="{{ __('Email') }}" />
            <x-sistem.forms.input-form id="email" type="text" placeholder="{{ __('Email') }}" wire:model="email" />
            <x-sistem.forms.input-error for="email" />
          </div>

          <div>
            <x-sistem.forms.label-form for="phone" value="{{ __('Celular') }}" />
            <x-sistem.forms.input-form id="phone" type="text" placeholder="{{ __('Celular') }}" wire:model="phone" />
            <x-sistem.forms.input-error for="phone" />
          </div>

          <div>
            <x-sistem.forms.label-form for="adress" value="{{ __('Direccion') }}" />
            <x-sistem.forms.input-form id="adress" type="text" placeholder="{{ __('Direccion') }}" wire:model="adress" />
            <x-sistem.forms.input-error for="adress" />
          </div>

          <div>
            <x-sistem.forms.label-form for="city" value="{{ __('Ciudad') }}" />
            <x-sistem.forms.input-form id="city" type="text" placeholder="{{ __('Ciudad') }}" wire:model="city" />
            <x-sistem.forms.input-error for="city" />
          </div>

          <div>
            <x-sistem.forms.label-form for="country" value="{{ __('Pais') }}" />
            <x-sistem.forms.input-form id="country" type="text" placeholder="{{ __('Pais') }}" wire:model="country" />
            <x-sistem.forms.input-error for="country" />
          </div>
  
          <div>
            <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
            <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingresar una breve descripcion') }}"
              wire:model="description" />
            <x-sistem.forms.input-error for="description" />
          </div>

  
          <div>
            <label for="status" class="flex items-center">
              <x-sistem.forms.checkbox-form id="status" wire:model="status" />
              <br><span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
            </label>
          </div>

        </div>
      </x-slot>

      <x-slot name="actions">

        <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
        <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
          title="{{$client ? 'Actualizar' : 'Guardar'}}">
          <div wire:loading>
            <x-sistem.spinners.loading-spinner-btn />
          </div>
        </x-sistem.buttons.primary-btn>
      </x-slot>

    </x-sistem.forms.form-section>

    <x-sistem.menus.section-border />


  </x-slot>

  <x-slot name="footer">
  </x-slot>
</x-sistem.modal.dialog-modal>


<x-sistem.modal.dialog-modal wire:model="showViewModal">
  <x-slot name="title">
      {{ __('Ver datos') }}
  </x-slot> 

  <x-slot name="content">

    <div class="grid gap-3 p-1">


      <p class="text-gray-900 font-bold text-base uppercase mr-3">Nombre: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->lastname ?? ''}}, {{ $client->name ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Celular: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->phone ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Email: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->email ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Direccion: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->adress ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Ciudad: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->city ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Pais: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->country ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Descripcion: 
        <br><span class="text-gray-700 italic text-sm normal-case whitespace-pre-wrap">{{ $client->description ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Estado: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ ($client->status ?? '') ? 'Activo' : 'Inactivo'}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Ultima modificacion por: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->user->lastname ?? ''}}, {{ $client->user->name ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Empresa: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $client->company->name ?? ''}}</span>
      </p>
    </div>

  </x-slot>

  <x-slot name="footer">
  </x-slot>
</x-sistem.modal.dialog-modal>