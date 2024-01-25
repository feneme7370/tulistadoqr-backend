<div class="w-11/12 mx-auto my-1">
    
    <div>
        <x-sistem.buttons.primary-btn wire:click="downloadQR" class="sm:mx-auto sm:mr-2" wire:loading.attr="disabled" wire:loading.class="opacity-50" title="Descargar QR"/>
    </div>
    
    <form class="grid grid-cols-1 gap-2 mt-2">

        {{-- datos de la empresa --}}
        <h2 class="text-center font-bold text-xl">Datos de la empresa</h2>

        {{-- inputs --}}
        <div class="grid md:grid-cols-2 gap-3">

            <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    autofocus />
                <x-sistem.forms.input-error for="name" />
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
        </div>

        {{-- imagen de portada empresa --}}
        <div class="bg-gray-100 p-1 rounded-md">
            <h2 class="text-center font-bold text-xl">Imagen principal de la empresa</h2>
    
            <div>
                <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen de portada') }}" />
                <x-sistem.forms.input-file-form id="image_hero_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 3 mg)" wire:model="image_hero_new" accept="image/*"
                     />
                <x-sistem.forms.input-error for="image_hero_new" />
            </div>
    
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
    
                <div class="">
                    <p class="mb-1">Imagen de portada actual:</p>
                    <div class="w-64 h-64 mx-auto relative">
                        @if ($this->image_hero && $this->image_hero != '')
                            <img src="{{asset('archives/images/hero/'.$this->image_hero)}}" alt="imagen" class="w-64 h-64 object-cover rounded-md" />
                            <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">Eliminar</button>
                        @else
                            <img class="w-64 h-64 object-cover rounded-md" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
                        @endif
                    </div>
                </div>
                
                <div class="">
    
                    <div wire:loading wire:target="image_hero_new">
                        <x-sistem.spinners.loading-spinner/>
                    </div>
    
                    <p class="mb-1">Imagen de portada nueva:</p>
                    @if ($image_hero_new) 
                        <div class="w-64 h-64 mx-auto relative">
                            <img class="relative w-64 h-64 object-cover rounded-md" src="{{ $image_hero_new->temporaryUrl() }}">
                        </div>
                    @else
                        <p class="text-center italic">No se ha agregado una imagen nueva</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- logo de la empresa --}}
        <div class="bg-gray-100 p-1 rounded-md">
            <h2 class="text-center font-bold text-xl">Logo de la empresa</h2>
            <div>
                <x-sistem.forms.label-form for="image_logo_new" value="{{ __('Imagen de logo') }}" />
                <x-sistem.forms.input-file-form id="image_logo_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 3 mg)" wire:model="image_logo_new" accept="image/*"
                     />
                <x-sistem.forms.input-error for="image_logo_new" />
            </div>
    
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
    
                <div class="">
                    <p class="mb-1">Imagen del logo actual:</p>
                    <div class="w-64 h-64 mx-auto relative">
                        @if ($this->image_logo && $this->image_logo != '')
                            <img src="{{asset('archives/images/logo/'.$this->image_logo)}}" alt="imagen" class="w-64 h-64 object-cover rounded-md" />
                            <button wire:click='deleteImageLogoEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 text-sm rounded-lg text-white">Eliminar</button>
                        @else
                            <img class="w-64 h-64 object-cover rounded-md" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
                        @endif
                    </div>
                </div>
                
                <div class="">
                    
                    <div wire:loading wire:target="image_logo_new">
                        <x-sistem.spinners.loading-spinner/>
                    </div>
    
                    <p class="mb-1">Imagen del logo nueva:</p>
                    @if ($image_logo_new) 
                        <div class="w-64 h-64 mx-auto relative">
                            <img class="relative w-64 h-64 object-cover rounded-md" src="{{ $image_logo_new->temporaryUrl() }}">
                        </div>
                    @else
                        <p class="text-center italic">No se ha agregado una imagen nueva</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- informacion de la empresa --}}
        <h2 class="text-center font-bold text-xl">Informacion de la empresa</h2>

        {{-- descripcion --}}
        <div>
            <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
            <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingrese una breve descripcion') }}"
                wire:model="description" />
            <x-sistem.forms.input-error for="description" />
        </div>

        {{-- redes sociales --}}
        <div class="grid md:grid-cols-2 gap-3">
            @foreach($socialMedia as $social)
            <div>
                <x-sistem.forms.label-form for="socialMediaData.{{$social->id }}" value=" {{ $social->name }}:" />
                <x-sistem.forms.input-form id="socialMediaData.{{$social->id }}" type="text" placeholder="URL de {{ $social->name }}" wire:model="socialMediaData.{{$social->id }}" 
                />
                <x-sistem.forms.input-error for="socialMediaData.{{$social->id }}" />
            </div>
            @endforeach
        </div>

        <x-sistem.buttons.primary-btn wire:click="save" class="sm:mx-auto sm:mr-2" wire:loading.attr="disabled" wire:loading.class="opacity-50" title="Actualizar"/>
    </form>
</div>
