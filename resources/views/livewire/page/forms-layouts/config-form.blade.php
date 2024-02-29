<div>

{{-- form datos --}}
<x-sistem.forms.form-section submit="save">
    <x-slot name="title">
      {{ __('Datos') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Ajuste los datos de su empresa.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid gap-2 w-full">
    
            <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                />
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

        </div>
    </x-slot>

    <x-slot name="actions">
    </x-slot>

</x-sistem.forms.form-section>

{{-- form descripcion --}}
<x-sistem.forms.form-section submit="save">
    <x-slot name="title">
      {{ __('Descripciones') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Registre las descripciones de la empresa, se van a ver reflejadas en la pagina principal.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid gap-2 w-full">
    
            {{-- breve descripcion --}}
            <div>
                <x-sistem.forms.label-form for="short_description" value="{{ __('Breve descripcion') }}" />
                <x-sistem.forms.textarea-form id="short_description" placeholder="{{ __('Ingrese una breve descripcion') }}"
                    wire:model="short_description" />
                <x-sistem.forms.input-error for="short_description" />
            </div>
            {{-- descripcion --}}
            <div>
                <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingrese una descripcion') }}"
                    wire:model="description" />
                <x-sistem.forms.input-error for="description" />
            </div>
            {{-- descripcion de horarios --}}
            <div>
                <x-sistem.forms.label-form for="times_description" value="{{ __('Descripcion de horarios') }}" />
                <x-sistem.forms.textarea-form id="times_description" placeholder="{{ __('Ej. Lunes a Jueves 10:00 a 22:00 - Viernes a Domingo 10:00 a 11:30') }}"
                    wire:model="times_description" />
                <x-sistem.forms.input-error for="times_description" />
            </div>

        </div>
    </x-slot>

    <x-slot name="actions">
    </x-slot>

</x-sistem.forms.form-section>

{{-- form redes --}}
<x-sistem.forms.form-section submit="save">
    <x-slot name="title">
      {{ __('Redes Sociales') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Agregue las redes sociales de su empresa, se veran reflejadas en la pagina principal.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid gap-2 w-full">
    
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

        </div>
    </x-slot>

    <x-slot name="actions">
    </x-slot>

</x-sistem.forms.form-section>

{{-- form personalizar --}}
<x-sistem.forms.form-section submit="save">
    <x-slot name="title">
      {{ __('Personalizar') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Eliga la opcion que mas le guste para la pagina principal.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid gap-2 w-full">
    
            <div>
                <x-sistem.forms.label-form for="type_menu" value="{{ __('Tipo de menu') }}" />
                <x-sistem.forms.select-form wire:model="type_menu" id="type_menu">
                    <option value="1">Menu Acordion</option>
                    <option value="2">Listado</option>
                    <option value="3">Secciones</option>
                    <option value="4">Tabla</option>
                </x-sistem.forms.select-form>
                <x-sistem.forms.input-error for="type_menu" />
            </div>

        </div>
    </x-slot>

    <x-slot name="actions">
    </x-slot>

</x-sistem.forms.form-section>

{{-- form imagenes --}}
<x-sistem.forms.form-section submit="save">
    <x-slot name="title">
      {{ __('Imagenes') }}
    </x-slot>

    <x-slot name="description">
      {{ __('Agregue la imagen de portada y de logo.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid gap-2 w-full">
    
            {{-- imagen de portada empresa --}}
            <div class="bg-gray-100 p-1 rounded-md">
                <h2 class="text-center text-gray-900 font-bold text-xl">Imagen principal de la empresa</h2>
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
            
                    <div class="flex justify-center items-center">
                        @if ($image_hero_new)
                        <div class="">
            
                            <div wire:loading wire:target="image_hero_new">
                                <x-sistem.spinners.loading-spinner/>
                            </div>
            
                            <p class="mb-1">Nueva:</p>
                                <x-sistem.lightbox.img-lightbox 
                                    class="h-32 w-32 p-1 bg-primary-200"
                                    :name="$image_hero_new->temporaryUrl()"    
                                />
                        </div>
                        @else
                        <div class="">
                            <div wire:loading wire:target="image_hero_new">
                                <x-sistem.spinners.loading-spinner/>
                            </div>
                            <p class="mb-1">Actual:</p>
                            <div class="h-32 w-32 mx-auto relative">
        
                                <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                                    <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                                </button>
                                
                                <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                    <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                                </button>
                                
                                <x-sistem.lightbox.img-tumb-lightbox 
                                    class="h-32 w-32 p-1 bg-primary-200"
                                    :uri="$this->image_hero_uri" 
                                    :name="$this->image_hero"    
                                />
                            </div>
                        </div>
                        @endif
        
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen de portada') }}" />
                        <x-sistem.forms.input-file-form id="image_hero_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_hero_new" accept="image/*"
                            />
                        <x-sistem.forms.input-error for="image_hero_new" />
                    </div>

                </div>
            </div>
    
            {{-- logo de la empresa --}}
            <div class="bg-gray-100 p-1 rounded-md">
                <h2 class="text-center text-gray-900 font-bold text-xl">Logo de la empresa</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-1">

                    <div class="flex justify-center items-center">
                
                        @if ($image_logo_new)
                        <div class="">
            
                            <div wire:loading wire:target="image_logo_new">
                                <x-sistem.spinners.loading-spinner/>
                            </div>
            
                            <p class="mb-1">Nueva:</p>
                                <x-sistem.lightbox.img-lightbox 
                                    class="h-32 w-32 p-1 bg-primary-200"
                                    :name="$image_logo_new->temporaryUrl()"    
                                />
                        </div>
                        @else
                        <div class="">
                            <div wire:loading wire:target="image_logo_new">
                                <x-sistem.spinners.loading-spinner/>
                            </div>
                            <p class="mb-1">Actual:</p>
                            <div class="h-32 w-32 mx-auto relative">
                                <button wire:click='deleteImageLogoEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white flex items-center justify-center">
                                    <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                                </button>
                                
                                <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                    <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                                </button>
                                <x-sistem.lightbox.img-lightbox 
                                    class="h-32 w-32 p-1 bg-primary-200"
                                    :uri="$this->image_logo_uri" 
                                    :name="$this->image_logo"    
                                />
                            </div>
                        </div>
                        @endif
                    </div>

                    <div>
                        <x-sistem.forms.label-form for="image_logo_new" value="{{ __('Imagen de logo') }}" />
                        <x-sistem.forms.input-file-form id="image_logo_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_logo_new" accept="image/*"
                            />
                        <x-sistem.forms.input-error for="image_logo_new" />
                    </div>

                </div>
            </div>

            <div wire:loading class="mx-auto">
                <x-sistem.spinners.loading-spinner/>
            </div>

        </div>
    </x-slot>

    <x-slot name="actions">
        <x-sistem.buttons.primary-btn 
        wire:click="save"
        wire:loading.class="opacity-50" 
        wire:loading.attr="disabled"
        class="max-w-80 mx-auto"
        title="Actualizar" >
        <div wire:loading>
            <x-sistem.spinners.loading-spinner-btn/>
        </div>
    </x-sistem.buttons.primary-btn> 
    </x-slot>

</x-sistem.forms.form-section>

</div>