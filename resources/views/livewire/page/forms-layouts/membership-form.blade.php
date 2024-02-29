<x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
        {{ __('Formulario para ' . ($membership ? 'editar' : 'agregar') . ' datos') }}
    </x-slot>
  
    <x-slot name="content">
        <x-sistem.forms.form-section submit="save">
          <x-slot name="title">
            {{ __($membership ? 'Editar' : 'Agregar') }}
          </x-slot>
  
          <x-slot name="description">
            {{ __('Administre las membresias, los limites de cada una, ponga un precio o si puede utilizar el menu.') }}
          </x-slot>
  
          <x-slot name="form">
            <div class="grid gap-2 w-full">
  
                <x-sistem.forms.validation-errors class="mb-4" />
        
                <div>
                <x-sistem.forms.label-form for="name" value="{{ __('Nombre de la membresia') }}" />
                <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name"
                    />
                <x-sistem.forms.input-error for="name" />
                </div>
                
                <div>
                <x-sistem.forms.label-form for="price" value="{{ __('Precio') }}" />
                <x-sistem.forms.input-form id="price" type="text" placeholder="{{ __('Precio') }}" wire:model="price"
                    />
                <x-sistem.forms.input-error for="price" />
                </div>

                <div>
                <x-sistem.forms.label-form for="short_description" value="{{ __('Breve descripcion') }}" />
                <x-sistem.forms.textarea-form id="short_description" type="text" placeholder="{{ __('Breve descripcion') }}" wire:model="short_description"
                    />
                <x-sistem.forms.input-error for="short_description" />
                </div>

                <div>
                <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
                <x-sistem.forms.textarea-form id="description" type="text" placeholder="{{ __('Descripcion') }}" wire:model="description"
                    />
                <x-sistem.forms.input-error for="description" />
                </div>
                    
                <div>
                <x-sistem.forms.label-form for="category" value="{{ __('Categorias') }}" />
                <x-sistem.forms.input-form id="category" type="text" placeholder="{{ __('Cantidad') }}" wire:model="category"
                    />
                <x-sistem.forms.input-error for="category" />
                </div>
                    
                <div>
                <x-sistem.forms.label-form for="level" value="{{ __('Niveles') }}" />
                <x-sistem.forms.input-form id="level" type="text" placeholder="{{ __('Cantidad') }}" wire:model="level"
                    />
                <x-sistem.forms.input-error for="level" />
                </div>
                    
                <div>
                <x-sistem.forms.label-form for="product" value="{{ __('Productos') }}" />
                <x-sistem.forms.input-form id="product" type="text" placeholder="{{ __('Cantidad') }}" wire:model="product"
                    />
                <x-sistem.forms.input-error for="product" />
                </div>
                    
                <div>
                <x-sistem.forms.label-form for="user" value="{{ __('Usuarios') }}" />
                <x-sistem.forms.input-form id="user" type="text" placeholder="{{ __('Cantidad') }}" wire:model="user"
                    />
                <x-sistem.forms.input-error for="user" />
                </div>
                    
                <div>
                <x-sistem.forms.label-form for="tag" value="{{ __('Etiquetas') }}" />
                <x-sistem.forms.input-form id="tag" type="text" placeholder="{{ __('Cantidad') }}" wire:model="tag"
                    />
                <x-sistem.forms.input-error for="tag" />
                </div>
                    
                <div>
                <x-sistem.forms.label-form for="suggestion" value="{{ __('Sugerencias') }}" />
                <x-sistem.forms.input-form id="suggestion" type="text" placeholder="{{ __('Cantidad') }}" wire:model="suggestion"
                    />
                <x-sistem.forms.input-error for="suggestion" />
                </div>
                    
                <div>
                <label for="list_product" class="flex items-center">
                    <x-sistem.forms.checkbox-form id="list_product" wire:model="list_product" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lista de productos') }}</span>
                </label>
                </div>
                <div>
                <label for="status" class="flex items-center">
                    <x-sistem.forms.checkbox-form id="status" wire:model="status" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
                </label>
                </div>

            </div>
          </x-slot>
  
          <x-slot name="actions">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
            title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
              title="{{$membership ? 'Actualizar' : 'Guardar'}}">
              <div wire:loading>
                <x-sistem.spinners.loading-spinner-btn />
              </div>
            </x-sistem.buttons.primary-btn>
          </x-slot>
  
        </x-sistem.forms.form-section>
    </x-slot>
  
    <x-slot name="footer">
    </x-slot>
</x-sistem.modal.dialog-modal>