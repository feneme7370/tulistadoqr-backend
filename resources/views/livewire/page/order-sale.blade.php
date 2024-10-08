<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts 
        :messageSuccess="session('messageSuccess')" 
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Ventas">

    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Puede ver la ganancia que se produce de la cantidad de ventas, con su costo estandar registrado. Aqui se encuentran todas las ordenes que fueron marcadas como pagadas.</p>
    </x-sistem.menus.text-info>


    {{-- input buscador y filtro de activos --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
        <x-sistem.filter.search-only />
        <x-sistem.filter.search-dates />
        
    </div>
    {{-- <x-sistem.filter.search-checkbox 
        placeholder_box_1="Solo completados"
        property_box_1="active"
    /> --}}


        {{-- mini datos --}}
        <div class="grid grid-cols-1 gap-3 mb-8 md:grid-cols-3">
       
            <div>
                <x-sistem.cards.mini-date-money 
                    href="{{route('orders.index')}}" 
                    title="Ventas" 
                    {{-- date="{{ number_format($amount_total_price, 2,",",".") }}" --}}
                    date="{{$amount_total_price }}"
                >
                        <x-sistem.icons.for-icons-app icon="membership"/>
                </x-sistem.cards.mini-date>            
            </div>
            <div>
                <x-sistem.cards.mini-date-money 
                    href="{{route('orders.index')}}" 
                    title="Costos" 
                    {{-- date="{{ number_format($amount_total_price, 2,",",".") }}" --}}
                    date="{{$amount_total_cost }}"
                >
                        <x-sistem.icons.for-icons-app icon="membership"/>
                </x-sistem.cards.mini-date>            
            </div>
            <div>
                <x-sistem.cards.mini-date-money 
                    href="{{route('orders.index')}}" 
                    title="Ganancias" 
                    {{-- date="{{ number_format($amount_total_price, 2,",",".") }}" --}}
                    date="{{$amount_total_price - $amount_total_cost }}"
                >
                        <x-sistem.icons.for-icons-app icon="membership"/>
                </x-sistem.cards.mini-date>            
            </div>
     
        </div>

    {{-- listado --}}
    @include('livewire.page.tables-layouts.order_sale-table')

    <div class="my-5"></div>

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Ventas mensuales">

        <div>
            <x-sistem.forms.select-form wire:model.live="years_sales" id="years_sales">
                @foreach ($sales_years as $sales_year)
                    <option value="{{$sales_year}}">{{$sales_year}}</option>
                @endforeach
            </x-sistem.forms.select-form>
          </div>
        

    </x-sistem.menus.title-and-btn>

    {{-- listado --}}
    @include('livewire.page.tables-layouts.order_sale_month-table')

    {{-- Paginacion --}}
    <div class="mt-2">{{ $products->onEachSide(1)->links() }}</div>
</div>
