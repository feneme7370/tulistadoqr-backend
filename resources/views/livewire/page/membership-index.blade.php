<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Membresias">
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
    <x-sistem.filter.search-active />

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- listado --}}
    @include('livewire.page.tables-layouts.membership-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $memberships->onEachSide(1)->links() }}</div>

    <!-- Modal para borrar -->
    @include('livewire.page.forms-layouts.membership-form')

    <!-- Modal para crear y editar -->
    <x-sistem.modal.dialog-modal wire:model="showActionModal">
        <x-slot name="title">
          {{ __($membership ? 'Editar' : 'Agregar') }}
        </x-slot>

        <x-slot name="content">
          <form {{-- method="POST" --}} class="grid gap-2 mt-2">

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

          </form>

        </x-slot>

        <x-slot name="footer">
            <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled" title="Cancelar" />
            <x-sistem.buttons.primary-btn wire:click="save" wire:loading.attr="disabled" title="{{ __($membership ? 'Actualizar' : 'Guardar') }}"  />
        </x-slot>
    </x-sistem.modal.dialog-modal>

    @push('scripts')
      <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
      <script>
        Livewire.on('deleteMembership', (event, nameDispatch) => {
          sweetalert2Delete(event, 'deleteMembershipId')
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