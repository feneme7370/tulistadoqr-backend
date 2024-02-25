<div>
  {{-- mensaje de alerta --}}
  <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')" :messageError="session('messageError')" />

  {{-- titulo y boton --}}
  <x-sistem.menus.title-and-btn title="Categorias Generales">

    <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
      @slot('icon')
      <x-sistem.icons.hi-plus-circle />
      @endslot
    </x-sistem.buttons.primary-btn>

  </x-sistem.menus.title-and-btn>

  {{-- texto informativo --}}
  <x-sistem.menus.text-info>
    <p>Agregue categorias generales como "Bebidas", "Comidas", "Postres" o "Menu infantil". Los que se agreguen se
      podran asociar a un producto y luego poder ser filtrados en la pagina por cada rubro.</p>
  </x-sistem.menus.text-info>

  {{-- input buscador y filtro de activos --}}
  <x-sistem.filter.search-active />
  <x-sistem.spinners.loading-spinner wire:loading wire:target="search" />

  {{-- listado --}}
  <div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Creado por</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($levels as $item)
            <tr>

              <td class="with-id-columns">
                <p>{{$item->id}}</p>
              </td>
              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  {{-- <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                    wire:loading.attr="disabled" /> --}}
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteLevel', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td class="with-image-columns">
                <x-sistem.lightbox.img-tumb-lightbox :uri="$item->image_hero_uri" :name="$item->image_hero" />
              </td>

              <td>
                <p>{{$item->name}}</p>
              </td>
              <td>
                <p>{{$item->description}}</p>
              </td>
              <td>
                <p>{{$item->user->lastname}}, {{$item->user->name}}</p>
              </td>

              <td class="with-status-columns">
                <span
                  class="line-clamp-2 {{$item->status == '1' ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded' : 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounde'}}">
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
    {{ $levels->onEachSide(1)->links() }}
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
      <x-sistem.buttons.normal-btn wire:click="$set('showDeleteModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />

      <x-sistem.buttons.delete-btn wire:click="deleteLevel" wire:loading.attr="disabled" title="Borrar" />
    </x-slot>
  </x-sistem.modal.dialog-modal>

  <!-- Modal para crear y editar -->
  <x-sistem.modal.dialog-modal wire:model="showActionModal">
    <x-slot name="title">
      {{ __($level ? 'Editar' : 'Agregar') }}
    </x-slot>

    <x-slot name="content">
      <form class="grid gap-2 mt-2">

        <div>
          <x-sistem.forms.label-form for="name" value="{{ __('Nombre') }}" />
          <x-sistem.forms.input-form id="name" type="text" placeholder="{{ __('Nombre') }}" wire:model="name" />
          <x-sistem.forms.input-error for="name" />
        </div>

        <div>
          <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
          <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingresar una breve descripcion') }}"
            wire:model="description" />
          <x-sistem.forms.input-error for="description" />
        </div>

        <div>
          <label for="status" class="flex items-center">
            <x-sistem.forms.checkbox-form id="status" wire:model="status" />
            <span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
          </label>
        </div>

        {{-- imagen del nivel --}}
        <div class="bg-gray-100 p-1 rounded-md">
          <h2 class="text-center text-gray-900 font-bold text-xl">Imagen de categoria general</h2>

          <div>
            <x-sistem.forms.label-form for="image_hero_new" value="{{ __('Imagen de categoria general') }}" />
            <x-sistem.forms.input-file-form id="image_hero_new" type="file"
              description="JPG, JPEG, PNG o GIF (Max. 5 mb)" wire:model="image_hero_new" accept="image/*" />
            <x-sistem.forms.input-error for="image_hero_new" />
          </div>

          <div class="flex justify-center items-center">

            @if ($image_hero_new)
            <div class="">

              <div wire:loading wire:target="image_hero_new">
                <x-sistem.spinners.loading-spinner />
              </div>

              <p class="mb-1">Imagen de categoria general nueva:</p>
              <x-sistem.lightbox.img-lightbox class="h-64 max-w-96 p-1 bg-primary-200"
                :name="$image_hero_new->temporaryUrl()" />
            </div>
            @else
            <div class="">
              <div wire:loading wire:target="image_hero_new">
                <x-sistem.spinners.loading-spinner />
              </div>
              <p class="mb-1">Imagen de categoria general actual:</p>
              <div class="w-64 h-64 mx-auto relative">
                <button wire:click='deleteImageEdit' type="button"
                  class="absolute top-2 right-2 p-2 bg-red-600 rounded-lg text-sm text-white">Eliminar</button>
                  <button wire:click="rotateImage" type="button" class="absolute top-2 left-2 p-2 bg-gray-100 rounded-lg text-sm text-gray-600">Rotar</button>
                <x-sistem.lightbox.img-lightbox class="h-64 max-w-96 p-1 bg-primary-200" :uri="$this->image_hero_uri"
                  :name="$this->image_hero" />
              </div>
            </div>
            @endif
          </div>
        </div>
        <div wire:loading class="mx-auto">
          <x-sistem.spinners.loading-spinner/>
      </div>
      </form>

    </x-slot>

    <x-slot name="footer">
      <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
      <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
        title="{{$level ? 'Actualizar' : 'Guardar'}}">
        <div wire:loading>
          <x-sistem.spinners.loading-spinner-btn />
        </div>
      </x-sistem.buttons.primary-btn>
    </x-slot>
  </x-sistem.modal.dialog-modal>

  @push('scripts')
  <script>
        document.addEventListener('livewire:init', () => {
          Livewire.on('deleteLevel', (event) => {
            Swal.fire({
              title: 'Quieres eliminar el registro',
              text: "Se eliminara de forma definitiva",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#7e22ce',
              cancelButtonText: 'Cancelar',
              confirmButtonText: 'Si, eliminar'
              }).then((result) => {
                if (result.isConfirmed) {
                  // eliminar dato
                  Livewire.dispatch('deleteLevelId', {id : event})
                }
              })
        });
    })
  </script>

  <script>
    Livewire.on('toastifyLevel', (mensaje) => {
      Toastify({
        text: mensaje,
        duration: 4000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
          background: "#f0fdf4",
          color: "#166534",
        },
        onClick: function(){} // Callback after click
      }).showToast();
    })
  </script>
  @endpush
</div>