<div>
  
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- breadcrum, title y button --}}
      <x-pages.breadcrums.breadcrum 
      title_1="Inicio"
      link_1="{{ route('dashboard.index') }}"
      title_2="Sugerencias"
      link_2="{{ route('suggestions.index') }}"
      />

      <x-pages.menus.title-and-btn>

      @slot('title')
          <x-pages.titles.title-pages title="Sugerencias"/>
      @endslot

      @slot('button')

      @endslot
      </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    {{-- texto informativo --}}
      <x-pages.menus.text-info>
        <p>Agregue productos sugeridos, estos apareceran tambien en una seccion aparte del menu digital. Puede poner productos en oferta, platos del dia, etc.</p>
      </x-pages.menus.text-info>
    {{-- end texto informativo --}}

    {{-- logo de carga --}}
      <x-pages.spinners.loading-spinner wire:loading.delay />
    {{-- end logo de carga --}}

    {{-- categories,products and button --}}
      <div>
        <div class="grid grid-cols-12 gap-1 justify-center items-center">
          <x-pages.forms.select-form class="col-span-6" wire:model.live="categorySearch" value_placeholder="-- Categorias --">
      
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
        
            <x-pages.forms.select-form class="col-span-6" wire:model.live="product_id" value_placeholder="-- Productos --">
              @foreach ($products as $product)
                  <option value="{{$product->id}}">{{$product->name}}</option>
              @endforeach
            </x-pages.forms.select-form>
              
            
        </div>
    
        <div class="flex justify-end items-center">
          <x-pages.buttons.primary-btn 
            
            title="Agregar" 
            wire:click="save" 
            wire:loading.attr="disabled">
            
            @slot('icon')
                <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
    
          </x-pages.buttons.primary-btn>
        </div>
      </div>
    {{-- end categories,products and button --}}


    {{-- listado --}}
    @include('livewire.page.tables-layouts.suggestion-table')

    {{-- Paginacion --}}
      <div class="mt-2">{{ $suggestions->onEachSide(1)->links() }}</div>
    {{-- end Paginacion --}}
    
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