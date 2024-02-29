<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Empresas">
        <x-sistem.buttons.primary-btn 
            title="Agregar" 
            wire:click="createActionModal" 
            wire:loading.attr="disabled">
            @slot('icon')
              <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- input buscador y filtro de activos --}}
    <x-sistem.filter.search-active placeholder="Buscar por nombre o email"/>

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- listado --}}
    @include('livewire.page.tables-layouts.company-table')

    {{-- Paginacion --}}
    <div class="mt-2">
        {{ $companies->onEachSide(1)->links() }}
    </div>

    <!-- Modal para borrar -->
    <x-sistem.modal.dialog-modal wire:model="showDeleteModal">
        <x-slot name="title">
            {{ __('Borrar') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Desea eliminar el registro?') }}
        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showDeleteModal', false)" wire:loading.attr="disabled" title="Cancelar" />

            <x-sistem.buttons.delete-btn wire:click="deleteCompany()" wire:loading.attr="disabled"
            title="Borrar"/>
        </x-slot>
    </x-sistem.modal.dialog-modal>

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
            {{ __($company ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">
          <form class="grid gap-2 mt-2">

            <x-sistem.forms.validation-errors class="mb-4" />

            {{-- inputs de datos --}}
            <div>
              <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre de la empresa') }}" />
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
              
              <div>
                <x-sistem.forms.label-form for="url" value="{{ __('URL') }}" />
                <x-sistem.forms.input-form id="url" type="text" placeholder="{{ __('URL') }}" wire:model="url"
                     />
                <x-sistem.forms.input-error for="url" />
              </div>

              {{-- <div>
                <x-sistem.forms.label-form for="social" value="{{ __('Redes sociales') }}" />
                <x-sistem.forms.input-form id="social" type="text" placeholder="{{ __('Redes Sociales') }}" wire:model="social"
                     />
                <x-sistem.forms.input-error for="social" />
              </div> --}}

              <div>
                <x-sistem.forms.label-form for="membership_id" value="{{ __('Membresia') }}" />
                <x-sistem.forms.select-form wire:model="membership_id">
                    @foreach ($memberships as $membership)
                        <option value="{{$membership->id}}">{{$membership->name}}</option>
                    @endforeach
                </x-sistem.forms.select-form>
                <x-sistem.forms.input-error for="membership_id" />
              </div>
            </div>
              
            {{-- imagenes --}}
            <div>
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
                                  class="h-32 w-32 p-1 "
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
                            <button wire:click='deleteImageEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                                <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                            </button>
                            
                            {{-- <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                            </button> --}}
                            <x-sistem.lightbox.img-tumb-lightbox 
                                class="h-32 w-32 p-1 "
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
                                  class="h-32 w-32 p-1 "
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
                            <button wire:click='deleteImageLogoEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                                <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                            </button>
                            
                            {{-- <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                            </button> --}}
                            <x-sistem.lightbox.img-tumb-lightbox 
                                class="h-32 w-32 p-1 "
                                :uri="$this->image_logo_uri" 
                                :name="$this->image_logo"    
                            />
                          </div>
                      </div>
                    @endif
                  </div>
              </div>

              {{-- QR de la empresa --}}
              <div class="bg-gray-100 p-1 rounded-md">
                  <h2 class="text-center text-gray-900 font-bold text-xl">QR de la empresa</h2>
                  <div>
                      <x-sistem.forms.label-form for="image_qr_new" value="{{ __('Imagen de qr') }}" />
                      <x-sistem.forms.input-file-form id="image_qr_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_qr_new" accept="image/*"
                          />
                      <x-sistem.forms.input-error for="image_qr_new" />
                  </div>
          
                  <div class="flex justify-center items-center">
        
                    @if ($image_qr_new)
                      <div class="">
          
                          <div wire:loading wire:target="image_qr_new">
                              <x-sistem.spinners.loading-spinner/>
                          </div>
          
                          <p class="mb-1">Imagen de QR nueva:</p>
                              <x-sistem.lightbox.img-lightbox 
                                  class="h-32 w-32 p-1 "
                                  :name="$image_qr_new->temporaryUrl()"    
                              />
                      </div>
                    @else
                      <div class="">
                          <div wire:loading wire:target="image_qr_new">
                              <x-sistem.spinners.loading-spinner/>
                          </div>
                          <p class="mb-1">Imagen de QR actual:</p>
                          <div class="h-32 w-32 mx-auto relative">
                            <button wire:click='deleteImageQrEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">
                                <x-sistem.icons.for-icons-app icon="trash" class="h-3 w-3"/>
                            </button>
                            
                            {{-- <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">
                                <x-sistem.icons.for-icons-app icon="rotate" class="h-3 w-3"/>
                            </button> --}}
                            <x-sistem.lightbox.img-tumb-lightbox 
                                class="h-32 w-32 p-1 "
                                :uri="$this->image_qr_uri" 
                                :name="$this->image_qr"    
                            />
                          </div>
                      </div>
                    @endif
                  </div>
              </div>

            </div>
            {{-- descripcion --}}
            <div>
              {{-- breve descripcion --}}
              <div>
                  <x-sistem.forms.label-form for="short_description" value="{{ __('Breve descripcion') }}" />
                  <x-sistem.forms.textarea-form id="short_description" placeholder="{{ __('Ingrese una breve descripcion') }}"
                      wire:model="short_description" />
                  <x-sistem.forms.input-error for="short_description" />
              </div>
              <div>
                <x-sistem.forms.label-form for="description" value="{{ __('Descripcion de la empresa') }}" />
                <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Descripcion') }}"
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

              <div>
                <label for="status" class="flex items-center">
                    <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                </label>
              </div>
            </div>

            </form>
        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn 
              wire:click="save" 
              wire:loading.class="opacity-50" 
              wire:loading.attr="disabled"  
              title="{{$company ? 'Actualizar' : 'Guardar'}}" >
                <div wire:loading>
                    <x-sistem.spinners.loading-spinner-btn/>
                </div>
            </x-sistem.buttons.primary-btn> 
        </x-slot>
    </x-sistem.modal.dialog-modal>


    @push('scripts')
      <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
      <script>
        Livewire.on('deleteCompany', (event, nameDispatch) => {
          sweetalert2Delete(event, 'deleteCompanyId')
        });
      </script>

      <script src="{{ asset('lib/toastr/toastr-message.js') }}"></script>
      <script>
            Livewire.on('toastrError', (message) => {
              toastrError(message)
            })
            Livewire.on('toastrSuccess', (message) => {
              toastrSuccess(message)
            })
      </script>
    @endpush
</div>