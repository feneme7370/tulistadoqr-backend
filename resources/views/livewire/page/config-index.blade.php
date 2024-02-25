<div class="p-2 rounded-lg mx-auto my-1 ">
    
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    <x-sistem.menus.text-info class="">
        <p>Ajuste todos los datos de la empresa, cargue la imagen de portada y su logo en caso que sea una imagen. Tambien puede descargar aqui su codigo QR que redirecciona al menu digital.</p>
    </x-sistem.menus.text-info>

    <div>
        <x-sistem.buttons.primary-btn wire:click="downloadQR" class="sm:mx-auto sm:mr-2" wire:loading.attr="disabled" wire:loading.class="opacity-50" title="Descargar QR"/>
    </div>


    <form class="grid grid-cols-1 gap-2 mt-2">

    <div class="mb-4 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-gray-600 hover:text-gray-600 border-gray-600" data-tabs-inactive-classes="text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="dates-styled-tab" data-tabs-target="#styled-dates" type="button" role="tab" aria-controls="dates" aria-selected="true">Datos</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 " id="images-styled-tab" data-tabs-target="#styled-images" type="button" role="tab" aria-controls="images" aria-selected="false">Descripcion</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 " id="media-styled-tab" data-tabs-target="#styled-media" type="button" role="tab" aria-controls="media" aria-selected="false">Redes Sociales</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 " id="customize-styled-tab" data-tabs-target="#styled-customize" type="button" role="tab" aria-controls="customize" aria-selected="false">Personalizar</button>
            </li>
        </ul>
    </div>

    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-dates" role="tabpanel" aria-labelledby="dates-tab">

            {{-- datos de la empresa --}}
            <h2 class="text-center font-bold text-xl">Datos de la empresa</h2>

            {{-- inputs --}}
            <div class="grid md:grid-cols-2 gap-3">

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


        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-images" role="tabpanel" aria-labelledby="images-tab">
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
        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-media" role="tabpanel" aria-labelledby="media-tab">
            {{-- redes sociales --}}
            <h2 class="text-center font-bold text-xl">Redes sociales</h2>

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
        <div class="hidden p-4 rounded-lg bg-gray-50" id="styled-customize" role="tabpanel" aria-labelledby="customize-tab">
            {{-- personalizar pagina --}} 
            <h2 class="text-center font-bold text-xl">Personalizar pagina</h2>

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
    </div>


    <h2 class="text-center font-bold text-xl mb-3">Imagenes</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">

        {{-- imagen de portada empresa --}}
        <div class="bg-gray-100 p-1 rounded-md">
            <h2 class="text-center text-gray-900 font-bold text-xl">Imagen principal de la empresa</h2>
    
            <div>
                <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen de portada') }}" />
                <x-sistem.forms.input-file-form id="image_hero_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_hero_new" accept="image/*"
                    />
                <x-sistem.forms.input-error for="image_hero_new" />
            </div>
    
            <div class="flex justify-center items-center">
        
                @if ($image_hero_new)
                <div class="">
    
                    <div wire:loading wire:target="image_hero_new">
                        <x-sistem.spinners.loading-spinner/>
                    </div>
    
                    <p class="mb-1">Imagen de portada nueva:</p>
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
                    <p class="mb-1">Imagen de portada actual:</p>
                    <div class="h-32 w-32 mx-auto relative">
                        <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">Eliminar</button>
                        <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">Rotar</button>
                        <x-sistem.lightbox.img-tumb-lightbox 
                            class="h-32 w-32 p-1 bg-primary-200"
                            :uri="$this->image_hero_uri" 
                            :name="$this->image_hero"    
                        />
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- logo de la empresa --}}
        <div class="bg-gray-100 p-1 rounded-md">
            <h2 class="text-center text-gray-900 font-bold text-xl">Logo de la empresa</h2>
            <div>
                <x-sistem.forms.label-form for="image_logo_new" value="{{ __('Imagen de logo') }}" />
                <x-sistem.forms.input-file-form id="image_logo_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_logo_new" accept="image/*"
                    />
                <x-sistem.forms.input-error for="image_logo_new" />
            </div>
    
            <div class="flex justify-center items-center">
        
                @if ($image_logo_new)
                <div class="">
    
                    <div wire:loading wire:target="image_logo_new">
                        <x-sistem.spinners.loading-spinner/>
                    </div>
    
                    <p class="mb-1">Imagen de logo nueva:</p>
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
                    <p class="mb-1">Imagen de logo actual:</p>
                    <div class="h-32 w-32 mx-auto relative">
                        <button wire:click='deleteImageLogoEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">Eliminar</button>
                        <button wire:click="rotateImageLogo" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">Rotar</button>
                        <x-sistem.lightbox.img-lightbox 
                            class="h-32 w-32 p-1 bg-primary-200"
                            :uri="$this->image_logo_uri" 
                            :name="$this->image_logo"    
                        />
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div wire:loading class="mx-auto">
        <x-sistem.spinners.loading-spinner/>
    </div>

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
    </form>
</div>
