<div>
  {{-- mensaje de alerta --}}
  <x-sistem.notifications.alerts 
    :messageSuccess="session('messageSuccess')" 
    :messageError="session('messageError')" 
  />

    {{-- breadcrum, title y button --}}
      <x-pages.breadcrums.breadcrum 
      title_1="Inicio"
      link_1="{{ route('dashboard.index') }}"
      title_2="Etiquetas"
      link_2="{{ route('tags.index') }}"
      />

      <x-pages.menus.title-and-btn>

      @slot('title')
          <x-pages.titles.title-pages title="Etiquetas"/>
      @endslot

      @slot('button')
          <x-pages.buttons.primary-btn 
          title="Agregar" 
          wire:click="createActionModal" 
          wire:loading.attr="disabled">
          
          @slot('icon')
              <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
          @endslot

          </x-pages.buttons.primary-btn>
      @endslot
      </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

  {{-- texto informativo --}}
    <x-pages.menus.text-info>
      <p>Las etiquetas sirven reflejar una cualidad del producto, por ej. "Sin TACC", "Vegano", "Sin Sal", o si quiere aclarar algo como "Nuevo", "Oferta".</p>
    </x-pages.menus.text-info>
  {{-- end texto informativo --}}

  {{-- logo de carga --}}
    <x-pages.spinners.loading-spinner wire:loading.delay />
  {{-- end logo de carga --}}

  {{-- listado --}}
  @include('livewire.page.tables-layouts.tag-table')

  {{-- Paginacion --}}
    <div class="mt-2">{{ $tags->onEachSide(1)->links() }}</div>
  {{-- end Paginacion --}}

  <!-- Modal para crear y editar -->
  @include('livewire.page.forms-layouts.tag-form')

  @push('scripts')  
  
    <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
    <script>
      Livewire.on('deleteTag', (event, nameDispatch) => {
        sweetalert2Delete(event, 'deleteTagId')
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