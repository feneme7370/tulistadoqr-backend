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
                <x-sistem.icons.hi-plus-circle/>
            @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- input buscador y filtro de activos --}}
    <x-sistem.filter.search-active placeholder="Buscar por nombre o email"/>
    <x-sistem.spinners.loading-spinner wire:loading wire:target="search"/>

    {{-- listado --}}
    <div class="mx-auto">
            <!-- Ejemplo de una tarjeta -->

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                  <table class="t_table">
                    <thead>
                      <tr >
                        <th>ID</th>
                        <th>Acciones</th>
                        <th>Logo</th>
                        <th>Empresa</th>
                        <th>Email</th>
                        <th>Estado</th>
                      </tr>
                    </thead>
                    <tbody>
            
                        @foreach ($companies as $item)
                        <tr wire:key="field-company-{{ $item->id }}">

                          <td class="text-center"><p>{{$item->id}}</p></td>

                          <td>
                            <div class="actions">
                              <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                              <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                                wire:loading.attr="disabled" />
                            </div>
                          </td>

                          <td>
                            <div class="flex justify-center items-center text-sm">
                              <!-- Avatar with inset shadow -->
                              <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy">
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                              </div>
                            </div>
                          </td>

                          <td><p>{{$item->name}}</p></td>
                          <td><p>{{$item->email}}</p></td>

                          <td class="text-center">
                            <span class="line-clamp-2 {{$item->status == '1' ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300'}}">
                              {{$item->status == '1' ? 'Activo' : 'Inactivo'}}
                            </span>
                          </td>
                        </tr>
                        @endforeach
            
                    </tbody>
                  </table>
                </div>
              </div>

            <!-- Agrega más tarjetas aquí -->

    </div>

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
            title="Borrar" autofocus/>
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
                          
                          <div wire:loading wire:target="image_qr_new">
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

              {{-- QR de la empresa --}}
              <div class="bg-gray-100 p-1 rounded-md">
                  <h2 class="text-center font-bold text-xl">QR de la empresa</h2>
                  <div>
                      <x-sistem.forms.label-form for="image_qr_new" value="{{ __('Imagen de qr') }}" />
                      <x-sistem.forms.input-file-form id="image_qr_new" type="file" description="JPG, JPEG, PNG o GIF (Max. 3 mg)" wire:model="image_qr_new" accept="image/*"
                          />
                      <x-sistem.forms.input-error for="image_qr_new" />
                  </div>
          
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          
                      <div class="">
                          <p class="mb-1">Imagen del QR actual:</p>
                          <div class="w-64 h-64 mx-auto relative">
                              @if ($this->image_qr && $this->image_qr != '')
                                  <img src="{{asset('archives/images/qr/'.$this->image_qr)}}" alt="imagen" class="w-64 h-64 object-cover rounded-md" />
                                  <button wire:click='deleteImageQrEdit' type="button" class="absolute top-2 right-2 p-2 bg-red-600 text-sm rounded-lg text-white">Eliminar</button>
                              @else
                                  <img class="w-64 h-64 object-cover rounded-md" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
                              @endif
                          </div>
                      </div>
                      
                      <div class="">
                          
                          <div wire:loading wire:target="image_qr_new">
                              <x-sistem.spinners.loading-spinner/>
                          </div>
          
                          <p class="mb-1">Imagen del qr nueva:</p>
                          @if ($image_qr_new) 
                              <div class="w-64 h-64 mx-auto relative">
                                  <img class="relative w-64 h-64 object-cover rounded-md" src="{{ $image_qr_new->temporaryUrl() }}">
                              </div>
                          @else
                              <p class="text-center italic">No se ha agregado una imagen nueva</p>
                          @endif
                      </div>
                  </div>
              </div>

            </div>
            {{-- descripcion --}}
            <div>
              <div>
                <x-sistem.forms.label-form for="description" value="{{ __('Descripcion de la empresa') }}" />
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
            </div>

            </form>
        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{$company ? 'Actualizar' : 'Guardar'}}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>

</div>