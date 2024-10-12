<div>

    {{-- form datos --}}
    <x-pages.forms.jetstream.form-section submit="save">
        <x-slot name="title">
        {{ __('Datos') }}
        </x-slot>

        <x-slot name="description">
        {{ __('Ajuste los datos de su empresa que se veran en la pagina principal.') }}
        </x-slot>

        <x-slot name="form">
            <div class="grid gap-2 w-full">
        
                <div>
                    <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                    <x-pages.forms.input-form id="name" type="text" placeholder="{{ __('Nombre de la empresa') }}" wire:model="name"
                    />
                    <x-pages.forms.input-error for="name" />
                </div>
                
                <div>
                    <x-pages.forms.label-form for="email" value="{{ __('Email') }}" />
                    <x-pages.forms.input-form id="email" type="email" placeholder="{{ __('Email') }}" wire:model="email"
                        />
                    <x-pages.forms.input-error for="email" />
                </div>
                
                <div>
                    <x-pages.forms.label-form for="phone" value="{{ __('Telefono como se vera en la pagina') }}" />
                    <x-pages.forms.input-form id="phone" type="text" placeholder="{{ __('Numero que se vera en la pagina, ej. +54 9 2396 - 513953') }}" wire:model="phone"
                        />
                    <x-pages.forms.input-error for="phone" />
                </div>
                
                <div>
                    <x-pages.forms.label-form for="adress" value="{{ __('Direccion') }}" />
                    <x-pages.forms.input-form id="adress" type="text" placeholder="{{ __('Direccion fisica, ej. Arenales 356') }}" wire:model="adress"
                        />
                    <x-pages.forms.input-error for="adress" />
                </div>
                
                <div>
                    <x-pages.forms.label-form for="city" value="{{ __('Localidad') }}" />
                    <x-pages.forms.input-form id="city" type="text" placeholder="{{ __('Localidad, ej. Carlos Casares') }}" wire:model="city"
                        />
                    <x-pages.forms.input-error for="city" />
                </div>

            </div>
        </x-slot>

        <x-slot name="actions">
        </x-slot>

    </x-pages.forms.jetstream.form-section>

    {{-- form descripcion --}}
    <x-pages.forms.jetstream.form-section submit="save">
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
                    <x-pages.forms.label-form for="short_description" value="{{ __('Breve descripcion') }}" />
                    <x-pages.forms.textarea-form id="short_description" placeholder="{{ __('Breve descripcion que se vera en la portada principal') }}"
                        wire:model="short_description" />
                    <x-pages.forms.input-error for="short_description" />
                </div>
                {{-- descripcion --}}
                <div>
                    <x-pages.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                    <x-pages.forms.textarea-form id="description" placeholder="{{ __('Descripcion que se vera a mitad de la pagina principal') }}"
                        wire:model="description" />
                    <x-pages.forms.input-error for="description" />
                </div>
                {{-- descripcion de horarios --}}
                <div>
                    <x-pages.forms.label-form for="times_description" value="{{ __('Descripcion de horarios') }}" />
                    <x-pages.forms.textarea-form id="times_description" placeholder="{{ __('Ej. Lunes a Jueves 10:00 a 22:00 - Viernes a Domingo 10:00 a 11:30') }}"
                        wire:model="times_description" />
                    <x-pages.forms.input-error for="times_description" />
                </div>

            </div>
        </x-slot>

        <x-slot name="actions">
        </x-slot>

    </x-pages.forms.jetstream.form-section>

    {{-- form redes --}}
    <x-pages.forms.jetstream.form-section submit="save">
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
                        <x-pages.forms.label-form for="socialMediaData.{{$social->id }}" value=" {{ $social->name }}:" />
                        <x-pages.forms.input-form id="socialMediaData.{{$social->id }}" type="text" placeholder="URL o Numero sin guiones y con caracteristica de {{ $social->name }}" wire:model="socialMediaData.{{$social->id }}" 
                        />
                        <x-pages.forms.input-error for="socialMediaData.{{$social->id }}" />
                    </div>
                    @endforeach
                </div>

            </div>
        </x-slot>

        <x-slot name="actions">
        </x-slot>

    </x-pages.forms.jetstream.form-section>

    {{-- form personalizar --}}
    <x-pages.forms.jetstream.form-section submit="save">
        <x-slot name="title">
        {{ __('Personalizar') }}
        </x-slot>

        <x-slot name="description">
        {{ __('Eliga la opcion que mas le guste para la pagina principal.') }}
        </x-slot>

        <x-slot name="form">
            <div class="grid gap-2 w-full">
        
                <div>
                    <x-pages.forms.label-form for="type_menu" value="{{ __('Tipo de menu') }}" />
                    <x-pages.forms.select-form wire:model="type_menu" id="type_menu" value_empty="{{ false }}" class="text-center">
                        <option value="1">Menu Acordion</option>
                        <option value="2">Listado</option>
                        <option value="3">Secciones</option>
                        <option value="4">Carta</option>
                    </x-pages.forms.select-form>
                    <x-pages.forms.input-error for="type_menu" />
                </div>

            </div>
        </x-slot>

        <x-slot name="actions">
        </x-slot>

    </x-pages.forms.jetstream.form-section>

    {{-- form imagenes --}}
    <x-pages.forms.jetstream.form-section submit="save">
        <x-slot name="title">
        {{ __('Imagenes') }}
        </x-slot>

        <x-slot name="description">
        {{ __('Agregue la imagen de portada y de logo.') }}
        </x-slot>

        <x-slot name="form">
            <div class="grid gap-2 w-full">
        
                {{-- imagen de portada empresa --}}
                {{-- <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                        @if ($image_hero_new)
                            
                            <x-pages.libraries.lightbox.img-tumb-lightbox 
                                class="mx-auto"
                                class_w_h="h-32 w-32"
                                temporary="{{ true }}" tumb="{{ false }}"
                                :name="$image_hero_new->temporaryUrl()"   
                            />
                        @else
                            <x-pages.libraries.lightbox.img-tumb-lightbox 
                                class="mx-auto"
                                class_w_h="h-32 w-32"
                                :uri="$this->image_hero_uri" 
                                :name="$this->image_hero"    
                            />
                            
                        @endif
                        <div>
                            <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Portada</h3>
                            <div class="flex items-center space-x-4">
                                @if (!$image_hero_new)
                                    
                                    <x-pages.buttons.normal-btn 
                                    title="Rotar" 
                                    wire:click="rotateImage" 
                                    >
                                    
                                    @slot('icon')
                                        <x-sistem.icons.for-icons-app icon="rotate" class_w_h="h-4 w-4 fill-white"/>
                                    @endslot
                        
                                </x-pages.buttons.normal-btn>
                                    
                                    <x-pages.buttons.primary-btn 
                                    title="Borrar" 
                                    wire:click="deleteImageEdit" 
                                    >
                                    
                                    @slot('icon')
                                        <x-sistem.icons.for-icons-app icon="trash" class_w_h="h-4 w-4"/>
                                    @endslot
                        
                                </x-pages.buttons.primary-btn>


                                @endif
                            </div>
                            <div>
                                <x-pages.forms.label-form for="image_hero_new" value="{{ __('Imagen de portada') }}" />
                                <x-pages.forms.input-file-form id="image_hero_new" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model.live="image_hero_new" accept="image/*"
                                    />
                                <x-pages.forms.input-error for="image_hero_new" />
                            </div>
                            <x-pages.spinners.loading-spinner wire:loading wire:target="image_hero_new" />
                        </div>
                    </div>
                </div> --}}

                <x-pages.cards.upload-image 
                    new_image_file="{{$this->image_hero_new}}"
                    new_image_file_string="image_hero_new"
                    rotate="rotateImage"
                    delete="deleteImageEdit"
                    image_file_uri="{{ $this->image_hero_uri }}"
                    image_file_name="{{ $this->image_hero }}"
                    title="Portada"
                    title_2="Imagen de portada"
                />

                {{-- imagen de logo empresa --}}
                <x-pages.cards.upload-image 
                    new_image_file="{{$this->image_logo_new}}"
                    new_image_file_string="image_logo_new"
                    rotate="rotateImageLogo"
                    delete="deleteImageLogoEdit"
                    image_file_uri="{{ $this->image_logo_uri }}"
                    image_file_name="{{ $this->image_logo }}"
                    title="Logo"
                    title_2="Imagen de logo"
                />
        

                <x-pages.spinners.loading-spinner wire:loading.delay />

            </div>
        </x-slot>

        <x-slot name="actions">

            <x-pages.buttons.primary-btn 
                title="Actualizar" 
                wire:click="save"
                class="max-w-80 mx-auto" 
            >
            </x-pages.buttons.primary-btn>

        </x-slot>

    </x-pages.forms.jetstream.form-section>

</div>