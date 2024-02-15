<div class="w-11/12 mx-auto my-1">
    
    <x-sistem.menus.text-info>
        <p>Ajuste todos los datos de la empresa, cargue la imagen de portada y su logo en caso que sea una imagen. Tambien puede descargar aqui su codigo QR que redirecciona al menu digital.</p>
    </x-sistem.menus.text-info>

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

        {{-- imagen de portada empresa --}}
        <div class="bg-gray-100 p-1 rounded-md">
            <h2 class="text-center font-bold text-xl">Imagen principal de la empresa</h2>
    
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
                          <x-sistem.lightbox.img-tumb-lightbox 
                              class="h-32 w-32 p-1 bg-purple-200"
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
                        <x-sistem.lightbox.img-tumb-lightbox 
                            class="h-32 w-32 p-1 bg-purple-200"
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
            <h2 class="text-center font-bold text-xl">Logo de la empresa</h2>
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
                              class="h-32 w-32 p-1 bg-purple-200"
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
                        <x-sistem.lightbox.img-lightbox 
                            class="h-32 w-32 p-1 bg-purple-200"
                            :uri="$this->image_logo_uri" 
                            :name="$this->image_logo"    
                        />
                      </div>
                  </div>
                @endif
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

        <x-sistem.buttons.primary-btn 
            wire:click="save"
            wire:loading.class="opacity-50" 
            wire:loading.attr="disabled"
            title="Actualizar" >
            <div wire:loading>
                <x-sistem.spinners.loading-spinner-btn/>
            </div>
        </x-sistem.buttons.primary-btn> 
    </form>
</div>
