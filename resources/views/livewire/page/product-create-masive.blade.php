<div>
    {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum 
        title_1="Inicio"
        link_1="{{ route('dashboard.index') }}"
        title_2="Precios masivos"
        link_2="{{ route('products.masive') }}"
        />

        <x-pages.menus.title-and-btn>

        @slot('title')
            <x-pages.titles.title-pages title="Creacion masiva"/>
        @endslot

        @slot('button')

        @endslot
        </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    {{-- texto informativo --}}
        <x-pages.menus.text-info>
            <p>Cree productos masivamente por cada categoria.</p>
        </x-pages.menus.text-info>
    {{-- end texto informativo --}}


    {{-- update prices --}}


              {{-- form descripcion y tags --}}
              <x-pages.forms.jetstream.form-section submit="save">
                <x-slot name="title">
                  {{ __('Producto') }}
                </x-slot>
        
                <x-slot name="description">
                  {{ __('Agregue productos de forma rapida.') }}
                </x-slot>
        
                <x-slot name="form">
                  <div class="grid w-full">
                    <div>
                        <x-pages.forms.label-form for="name" value="{{ __('Nombre') }}" />
                        <x-pages.forms.input-form id="name" type="name"
                            placeholder="{{ __('Nombre') }}" wire:model="name" autofocus/>
                        <x-pages.forms.input-error for="name" />
                    </div>
                    
                    <div>
                        <x-pages.forms.label-form for="category_id" value="{{ __('Categoria') }}" />
                        <x-pages.forms.select-form wire:model="category_id" id="category_id" value_placeholder="-- Seleccionar Categorias --">
                          @foreach ($levels as $level)
                            <optgroup label="{{$level->name}}">
                
                            @foreach ($categories as $category)
                                @if ($category->level->name == $level->name)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endif
                            @endforeach
                            
                            </optgroup>
                          @endforeach
                        </x-pages.forms.select-form>
                        <x-pages.forms.input-error for="category_id" />
                    </div>
  
                    <div>
                        <x-pages.forms.label-form for="price_original" value="{{ __('Precio original') }}" />
                        <x-pages.forms.input-form id="price_original" type="number"
                            placeholder="{{ __('Precio') }}" wire:model="price_original" />
                        <x-pages.forms.input-error for="price_original" />
                    </div>
    
                      <div>
                          <x-pages.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                          <x-pages.forms.textarea-form id="description"
                              placeholder="{{ __('Ingresar una breve descripcion para el 1º parrafo') }}" wire:model="description" />
                          <x-pages.forms.input-error for="description" />
                      </div>
                      
                      {{-- <x-sistem.notifications.alerts-input :messageErrorInput="session('messageErrorInput')" /> --}}
                      
                  </div>
                </x-slot>
        
                <x-slot name="actions">
                    <x-pages.buttons.primary-btn 
                    title="Guardar y seguir" 
                    wire:click="save" 
                  >
                  </x-pages.buttons.primary-btn>
                </x-slot>
        
              </x-pages.forms.jetstream.form-section>

    {{-- end update prices --}}
</div>
