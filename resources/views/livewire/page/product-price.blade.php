<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- breadcrum, title y button --}}
        <x-pages.breadcrums.breadcrum 
        title_1="Inicio"
        link_1="{{ route('dashboard.index') }}"
        title_2="Precios masivos"
        link_2="{{ route('products.price') }}"
        />

        <x-pages.menus.title-and-btn>

        @slot('title')
            <x-pages.titles.title-pages title="Precios masivos"/>
        @endslot

        @slot('button')
    
        @endslot
        </x-pages.menus.title-and-btn>
    {{-- end breadcrum, title y button --}}

    {{-- texto informativo --}}
        <x-pages.menus.text-info>
            <p>Puede cambiar el precio y precio de oferta de forma masiva por categoria.</p>
        </x-pages.menus.text-info>
    {{-- end texto informativo --}}

    {{-- filters --}}

        <div class="grid grid-cols-12 items-center gap-1">
            <div class="col-span-10">
                <x-pages.forms.input-form 
                wire:model.live.debounce.600ms="search" 
                placeholder="Buscar" 
                />
            </div>
            <div class="col-span-2">
                <x-pages.forms.select-form wire:model.live.debounce.600ms="perPage" value_empty="{{ false }}" class="text-center">
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
                placeholder_box_2="Ofertas"
                property_box_2="offers"
            />

            <div class="flex justify-between items-center gap-5">

                <x-pages.forms.select-form wire:model.live.debounce.600ms="categorySearch" value_placeholder="-- Seleccionar Categorias --">

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

                <div class="">
                    <x-pages.buttons.primary-btn 
                    title="Actualizar" 
                    wire:click="save" 
                    class="p-1"
                    wire:loading.class="opacity-50"  
                    wire:loading.attr="disabled">
                    
                    @slot('icon')
                    <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
                    @endslot
    
                    </x-pages.buttons.primary-btn>
                </div>
            </div>



            <div>

        </div>

    {{-- end filters --}}

    {{-- update prices --}}
        <div class="mt-5 grid grid-cols-3 justify-center items-center gap-1">

            <div>
                <x-pages.forms.label-form for="price_original" value="Precio original" />
                <x-pages.forms.input-form 
                wire:model="price_original" 
                placeholder="Precio original" 
                />
                <x-pages.forms.input-error for="price_original" />
            </div>
            
            <div>
                <x-pages.forms.label-form for="price_seller" value="Precio oferta" />
                <x-pages.forms.input-form 
                wire:model="price_seller" 
                placeholder="Precio oferta" 
                />
                <x-pages.forms.input-error for="price_seller" />
            </div>
            
            <div>
                <x-pages.forms.label-form for="cost" value="Costo" />
                <x-pages.forms.input-form 
                wire:model="cost" 
                placeholder="Costo" 
                />
                <x-pages.forms.input-error for="cost" />
            </div>

        </div>
    {{-- end update prices --}}

    {{-- logo de carga --}}
        <x-pages.spinners.loading-spinner wire:loading.delay />
    {{-- end logo de carga --}}

    {{-- listado --}}
    @include('livewire.page.tables-layouts.product-price-table')

    {{-- Paginacion --}}
        <div class="mt-2">{{ $products->onEachSide(1)->links() }}</div>
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