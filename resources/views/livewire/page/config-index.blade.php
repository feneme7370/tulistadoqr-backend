<div class="w-5/6 mx-auto">
    
    <form class="grid grid-cols-1 gap-3 mt-5">

        <div class="grid md:grid-cols-2 gap-3">

            <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre de empresa') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    autofocus />
                <x-sistem.forms.input-error for="name" />
            </div>
            
            <div>
                <x-sistem.forms.label-form for="email" value="{{ __('Email de empresa') }}" />
                <x-sistem.forms.input-form id="email" type="email" placeholder="{{ __('Email') }}" wire:model="email"
                    />
                <x-sistem.forms.input-error for="email" />
            </div>
            
            <div>
                <x-sistem.forms.label-form for="phone" value="{{ __('Telefono de empresa') }}" />
                <x-sistem.forms.input-form id="phone" type="text" placeholder="{{ __('Telefono') }}" wire:model="phone"
                    />
                <x-sistem.forms.input-error for="phone" />
            </div>
            
            <div>
                <x-sistem.forms.label-form for="adress" value="{{ __('Direccion de empresa') }}" />
                <x-sistem.forms.input-form id="adress" type="text" placeholder="{{ __('Direccion') }}" wire:model="adress"
                    />
                <x-sistem.forms.input-error for="adress" />
            </div>
            
            <div>
                <x-sistem.forms.label-form for="city" value="{{ __('Localidad de empresa') }}" />
                <x-sistem.forms.input-form id="city" type="text" placeholder="{{ __('Localidad') }}" wire:model="city"
                    />
                <x-sistem.forms.input-error for="city" />
            </div>
    
            <div>
                <x-sistem.forms.label-form for="social" value="{{ __('Redes sociales de empresa') }}" />
                <x-sistem.forms.input-form id="social" type="text" placeholder="{{ __('Redes Sociales') }}" wire:model="social"
                    />
                <x-sistem.forms.input-error for="social" />
            </div>
        </div>

        <div>
            <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen de portada') }}" />
            <x-sistem.forms.input-form id="image_hero_new" type="file" wire:model="image_hero_new" accept="image/*"
                 />
            <x-sistem.forms.input-error for="image_hero_new" />
        </div>

        <div class="flex flex-col items-center md:flex-row gap-10 md:justify-evenly mb-4">
            <div class="w-64 h-64 relative">
                <p class="mb-2">Imagen de portada actual:</p>
                @if ($this->image_hero && $this->image_hero != '')
                    <img src="{{asset('archives/images/hero/'.$this->image_hero)}}" alt="imagen" class="w-64 h-64 object-cover rounded-sm" />
                    <button wire:click='deleteImageEdit' type="button" class="absolute top-7 right-2 p-2 bg-red-600 rounded-lg text-white">Eliminar</button>
                @else
                    <img class="w-64 h-64 object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
                @endif
            </div>
            <div class="w-64 h-64 relative">
                <p wire:loading>Cargando</p>
                <p class="mb-2">Imagen de portada nueva:</p>
                @if ($image_hero_new) 
                    <img class="w-64 h-64 object-cover rounded-sm" src="{{ $image_hero_new->temporaryUrl() }}">
                @endif
            </div>
        </div>

        <div>
            <x-sistem.forms.label-form for="image_logo_new" value="{{ __('Imagen de logo') }}" />
            <x-sistem.forms.input-form id="image_logo_new" type="file" wire:model="image_logo_new" accept="image/*"
                 />
            <x-sistem.forms.input-error for="image_logo_new" />
        </div>

        <div class="flex flex-col items-center md:flex-row gap-10 md:justify-evenly mb-4">
            <div class="w-64 h-64 relative">
                <p class="mb-2">Imagen de logo actual:</p>
                @if ($this->image_logo && $this->image_logo != '')
                    <img src="{{asset('archives/images/logo/'.$this->image_logo)}}" alt="imagen" class="w-64 h-64 object-cover rounded-sm" />
                    <button wire:click='deleteImageLogoEdit' type="button" class="absolute top-7 right-2 p-2 bg-red-600 rounded-lg text-white">Eliminar</button>
                @else
                    <img class="w-64 h-64 object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
                @endif
            </div>
            <div class="w-64 h-64 relative">
                <p wire:loading>Cargando</p>
                <p class="mb-2">Imagen de logo nueva:</p>
                @if ($image_logo_new) 
                    <img class="w-64 h-64 object-cover rounded-sm" src="{{ $image_logo_new->temporaryUrl() }}">
                @endif
            </div>
        </div>

        <div>
            <x-sistem.forms.label-form for="description" value="{{ __('Descripcion de empresa') }}" />
            <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Descripcion') }}"
                wire:model="description" />
            <x-sistem.forms.input-error for="description" />
        </div>

        <div>
            @foreach($socialMedia as $social)
                <x-sistem.forms.label-form for="socialMediaData.{{$social->id }}" value=" {{ $social->name }} - {{ __('URL:') }}" />
                <x-sistem.forms.input-form id="socialMediaData.{{$social->id }}" type="text" placeholder="Red Social de {{ $social->name }}" wire:model="socialMediaData.{{$social->id }}" 
                />
                <x-sistem.forms.input-error for="socialMediaData.{{$social->id }}" />
            @endforeach
        </div>


        <x-sistem.buttons.primary-btn wire:click="save" class="ml-3 mx-auto" wire:loading.attr="disabled" wire:loading.class="opacity-50" title="Actualizar"/>
    </form>
</div>
