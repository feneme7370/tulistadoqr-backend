<div>
    
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Productos">
        <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
            @slot('icon')
            <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Agregue los productos que ofrece en su menu, puede agregar un precio de oferta, una imagen y si quiere una descripcion que quiera que el cliente vea del producto.</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y cantidad a mostrar --}}
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

    {{-- select y checkbox --}}
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

    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- listado --}}
    @include('livewire.page.tables-layouts.product-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $products->onEachSide(1)->links() }}</div>

    <!-- Modal para crear y editar -->
    @include('livewire.page.forms-layouts.product-form')

    @push('scripts')
        <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
        <script>
        Livewire.on('deleteProduct', (event, nameDispatch) => {
            sweetalert2Delete(event, 'deleteProductId')
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