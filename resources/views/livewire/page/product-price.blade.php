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
    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div  class="w-full">
            <x-sistem.forms.label-form for="categorySearch" value="{{ __('Categoria') }}" />
            <x-sistem.forms.select-form wire:model.live="categorySearch" id="categorySearch">
                @foreach ($levels as $level)
                <optgroup label="{{$level->name}}">

                  @foreach ($categories as $category)
                    @if ($category->level->name == $level->name)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                  @endforeach
                  
                </optgroup>
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

    <x-sistem.filter.bg-input class="flex-col md:flex-row">
    
        <div class="w-full">
            <x-sistem.forms.input-form 
                wire:model.live.debounce.600ms="search" 
                type="search" 
                placeholder="Buscar por nombre o categoria" 
                class="w-full" />
        </div>

        <div class="flex flex-row">
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
        </div>
    </x-sistem.filter.bg-input>

    <x-sistem.filter.bg-input class="mt-5">
    
        <div class="w-full">
            <div>
                <x-sistem.forms.label-form for="price_original" value="{{ __('Modificar precio original') }}" />
                <x-sistem.forms.input-form 
                    wire:model="price_original"
                    placeholder="Precio original" 
                    class="w-full" />
                <x-sistem.forms.input-error for="price_original" />
            </div>
        </div>
        <div class="w-full">
            <div>
                <x-sistem.forms.label-form for="price_seller" value="{{ __('Modificar precio de oferta') }}" />
                <x-sistem.forms.input-form 
                    wire:model="price_seller" 
                    placeholder="Precio de oferta" 
                    class="w-full" />
                <x-sistem.forms.input-error for="price_seller" />
            </div>
        </div>
        <div class="w-full">
            <div>
                <x-sistem.forms.label-form for="cost" value="{{ __('Costo del producto') }}" />
                <x-sistem.forms.input-form 
                    wire:model="cost" 
                    placeholder="Costo del producto" 
                    class="w-full" />
                <x-sistem.forms.input-error for="cost" />
            </div>
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

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- listado --}}
    @include('livewire.page.tables-layouts.product-price-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $products->onEachSide(1)->links() }}</div>

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