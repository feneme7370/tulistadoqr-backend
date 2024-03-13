<div>
  
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Sugerencias">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
      <p>Agregue productos sugeridos, estos apareceran tambien en una seccion aparte del menu digital. Puede poner productos en oferta, platos del dia, etc.</p>
    </x-sistem.menus.text-info>

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- input buscador y filtro de activos --}}
    <x-sistem.filter.bg-input class="flex-col md:flex-row">
      
      <div  class="w-full">
        <x-sistem.forms.label-form for="categorySearch" value="{{ __('Categoria') }}" />
        <x-sistem.forms.select-form wire:model.live="categorySearch" id="categorySearch">
            <option value=""> Todos </option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->level->name}} - {{$category->name}}</option>
            @endforeach
        </x-sistem.forms.select-form>
        <x-sistem.forms.input-error for="categorySearch" />
      </div>

      {{-- barra de select --}}
      <div class="w-full">
          <x-sistem.forms.label-form for="product_id" value="{{ __('Producto') }}" />
          <x-sistem.forms.select-form wire:model="product_id">
              @foreach ($products as $product)
                  <option value="{{$product->id}}">{{$product->name}}</option>
              @endforeach
          </x-sistem.forms.select-form>
          <x-sistem.forms.input-error for="product_id" />
      </div>

      {{-- boton de agregar --}}
      <div class="mt-3 md:mt-0 md:mr-2 flex gap-2 justify-center items-end md:justify-end w-full">
        <x-sistem.buttons.primary-btn
            title="Agregar"
            wire:click="save" 
            wire:loading.attr="disabled" 
            >
            @slot('icon')
            <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>
      </div>

    </x-sistem.filter.bg-input>

    {{-- listado --}}
    @include('livewire.page.tables-layouts.suggestion-table')

    {{-- Paginacion --}}
    <div class="mt-5 mb-40">{{ $suggestions->onEachSide(1)->links() }}</div>

    @push('scripts')
   
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