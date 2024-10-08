<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts 
        :messageSuccess="session('messageSuccess')" 
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Ordenes">

        <x-sistem.buttons.primary-btn title="Agregar" wire:click="createActionModal" wire:loading.attr="disabled">
        @slot('icon')
        <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
        @endslot
        </x-sistem.buttons.primary-btn>

    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Agregue los pedidos, seleccionando los productos, su cantidad y en caso que quiera hacerle un descuento. Puede marcar los que se encuentran pagados, entregados, o estan en stock para entregarle. De que sale los ingresos por ventas que se veran en el reporte.</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
        <x-sistem.filter.search-only />
        <x-sistem.filter.search-dates />
        
    </div>
    <x-sistem.filter.search-checkbox 
        placeholder_box_1="Sin stock"
        property_box_1="is_maked"
        placeholder_box_2="Sin pagar"
        property_box_2="is_paid"
        placeholder_box_3="Sin entregar"
        property_box_3="is_delivered"
        placeholder_box_4="Solo pendientes"
        property_box_4="active"
    />

    {{-- logo de carga --}}
    {{-- <x-sistem.spinners.loading-spinner wire:loading /> --}}
    
    {{-- listado --}}
    @include('livewire.page.tables-layouts.order-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $orders->onEachSide(1)->links() }}</div>

    <!-- Modal para crear y editar -->
    @include('livewire.page.forms-layouts.order-form')

    @push('scripts')  

        <script src="{{ asset('lib/sweetalert2/sweetalert2-delete.js') }}"></script>
        <script>
        Livewire.on('deleteOrder', (event, nameDispatch) => {
            sweetalert2Delete(event, 'deleteOrderId')
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
