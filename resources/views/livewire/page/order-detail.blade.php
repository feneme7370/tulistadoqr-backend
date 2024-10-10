<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts 
        :messageSuccess="session('messageSuccess')" 
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Ordenes a elaborar / reponer">

    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Vea los productos individuales que posee cada orden para tener un listado de lo que se debe elaborar, aqui se muestran todos los productos que en la orden se encuentran como sin stock, para poder ver que hay que reponer o elaborar</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
        <x-sistem.filter.search-only />
        <x-sistem.filter.search-dates />
        
    </div>
    <x-sistem.filter.search-checkbox 
        placeholder_box_1="Por dia"
        property_box_1="is_date"
        placeholder_box_2="Solo confirmados"
        property_box_2="active"
    />
    
    {{-- logo de carga --}}
    <x-sistem.spinners.loading-spinner wire:loading />

    {{-- listado --}}
    @include('livewire.page.tables-layouts.order_detail-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $products->onEachSide(1)->links() }}</div>
</div>
