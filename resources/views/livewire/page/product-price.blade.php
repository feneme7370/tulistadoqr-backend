<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Precios masivos">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Puede cambiar el precio y precio de oferta de forma masiva por categoria.</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    {{-- <div class="flex flex-row flex-1 justify-evenly items-center gap-2 p-2"> --}}
    <x-sistem.filter.bg-input class="flex-row flex-1">
    
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

        <div  class="w-1/4">
            <x-sistem.forms.label-form for="perPage" value="{{ __('Mostrar') }}" />
            <x-sistem.forms.select-form wire:model.live="perPage" id="perPage">
                <option value="10"> 10 </option>
                <option value="30"> 30 </option>
                <option value="50"> 50 </option>
                <option value="100"> 100 </option>
            </x-sistem.forms.select-form>
        </div>
    </x-sistem.filter.bg-input>

    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div class="w-full">
            <x-sistem.forms.input-form 
                wire:model.live.debounce.600ms="search" 
                type="search" 
                placeholder="Buscar por nombre o categoria" 
                class="w-full" />
        </div>
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
            <x-sistem.forms.label-form value="Solo activos">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="active" />
            </x-sistem.forms.label-form> 
        </div>
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
        <x-sistem.forms.label-form value="En oferta">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="offers" />
        </x-sistem.forms.label-form>
        </div>
    </x-sistem.filter.bg-input>

    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div class="w-full">
            <div>
                <x-sistem.forms.input-form 
                    wire:model="price_original"
                    placeholder="Precio original" 
                    class="w-full" />
            </div>
            <x-sistem.forms.input-error for="price_original" />
        </div>
        <div class="w-full">
            <div>
                <x-sistem.forms.input-form 
                    wire:model="price_seller" 
                    placeholder="Precio de oferta" 
                    class="w-full" />
            </div>
            <x-sistem.forms.input-error for="price_seller" />
        </div>
        
        <x-sistem.buttons.primary-btn 
        wire:click="save"
        wire:loading.class="opacity-50"  
        wire:loading.attr="disabled"
        title="Actualizar" >
        <div wire:loading>
            <x-sistem.spinners.loading-spinner-btn/>
        </div>
    </x-sistem.buttons.primary-btn> 
    </x-sistem.filter.bg-input>

    {{-- </div> --}}

    {{-- <x-sistem.filter.search-active placeholder="Buscar por nombre, nivel o categoria" /> --}}

    <x-sistem.spinners.loading-spinner wire:loading/>

    {{-- listado --}}
    @include('livewire.page.tables-layouts.product-price-table')

    {{-- Paginacion --}}
    <div class="mt-2">
        {{-- {{ $products->onEachSide(1)->links('pagination::windmill-pagination') }} --}}
        {{ $products->onEachSide(1)->links() }}
    </div>

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