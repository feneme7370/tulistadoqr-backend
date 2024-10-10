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
      title_2="Categorias Generales"
      link_2="{{ route('levels.index') }}"
    />

    <x-pages.menus.title-and-btn>
    
      @slot('title')
      <x-pages.titles.title-pages title="Categorias Generales"/>
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
      <p>Agregue categorias generales como "Bebidas", "Comidas", "Postres" o "Menu infantil". Los que se agreguen se
        podran asociar a un producto y luego poder ser filtrados en la pagina por cada rubro.</p>
    </x-pages.menus.text-info>
  {{-- end texto informativo --}}

  {{-- filters --}}
    <div class="flex justify-between items-center gap-1">

      <div class="w-4/5">
        <x-pages.forms.input-form 
        wire:model.live.debounce.600ms="search" 
        placeholder="Buscar" 
        />
      </div>

      <div class="w-1/5">
        <x-pages.forms.select-form wire:model.live="perPage" value_empty="{{ false }}" class="text-center">
            <option value="10"> 10 </option>
            <option value="30"> 30 </option>
            <option value="50"> 50 </option>
            <option value="100"> 100 </option>
        </x-pages.forms.select-form>
      </div>
    </div>

    <x-pages.menus.checkboxs-group 
      placeholder_box_1="Activos"
      property_box_1="active"
    />
  {{-- end filters --}}

  {{-- logo de carga --}}
    <x-pages.spinners.loading-spinner wire:loading.delay />
  {{-- end logo de carga --}}

  {{-- listado --}}
  @include('livewire.page.tables-layouts.level-table')

  {{-- Paginacion --}}
    <div class="mt-2 ">{{ $levels->onEachSide(1)->links() }}</div>
  {{-- end Paginacion --}}

  <!-- Modal para crear y editar -->
  @include('livewire.page.forms-layouts.level-form')

  @push('scripts')  

    <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
    <script>
      Livewire.on('deleteLevel', (event, nameDispatch) => {
        sweetalert2Delete(event, 'deleteLevelId')
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