<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Orden</th>
              <th>Venta</th>
              <th>Costo</th>
              <th>Ganancia</th>
              {{-- <th>Producto</th>
              <th>Categoria</th> --}}
            </tr>
          </thead>
          <tbody>

            @foreach ($sale_for_orders as $sale_for_order)
              <tr>
                
                <td class="with-id-columns">
                  <p>{{ ($sale_for_orders->currentPage() - 1) * $sale_for_orders->perPage() + $loop->iteration }}</p>
                </td>
                
                <td class="">
                  <p class="text-sm">{{$sale_for_order->date}}</p>
                </td>
                <td class="">
                  <p class="text-sm font-bold">{{$sale_for_order->customer->lastname}}, {{$sale_for_order->customer->name}} <span class="text-xs font-normal italic">({{$sale_for_order->client}})</span> </p>
                  <a href="{{ route('orders.index', ['q' => $sale_for_order->name, 'ds' => $sale_for_order->date, 'df' => $sale_for_order->date]) }}"><p class="hover:underline text-xs italic">{{$sale_for_order->name}}</p></a>
                </td>


                <td class="with-id-columns">
                  <p class="text-sm t_badge-green">${{ number_format($sale_for_order->total_price, 2,",",".") }} </p>
                </td>
                <td class="with-id-columns">
                  <p class="text-sm t_badge-red">${{number_format($sale_for_order->total_cost, 2,",",".")}} </p>
                </td>
                <td class="with-id-columns">
                  <p class="text-sm t_badge-blue font-bold">${{number_format(($sale_for_order->total_price - $sale_for_order->total_cost), 2,",",".")}} </p>
                </td>

                {{-- <td class="flex flex-col">
                  <p class="font-bold text-sm">{{$product->name}} </p>
                </td>
                <td class="">
                  <p class="text-sm">{{$product->category_name}} </p>
                </td> --}}

              </tr>
              
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>