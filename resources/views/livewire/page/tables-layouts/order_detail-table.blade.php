<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              @if ($is_date)
                
              <th>Fecha</th>
              @endif
              <th>Categoria</th>
              <th>Pedidos</th>
              <th>Stock</th>
              <th>Elaborar</th>
              <th>Producto</th>
            </tr>
          </thead>
          <tbody>
              
            @if($is_date ? $products = $products_with_date : $products)
            
              @foreach ($products as $product)
              <tr class="{{ $product->order_status == '1' ? '' : 't_tr-inactive' }}">
                
                <td class="with-id-columns">
                  <p>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</p>
                </td>
                
                @if ($is_date)
                <td class="">
                  <p class="text-sm">{{$product->order_date}}</p>
                </td>
                  
                @endif

                <td class="">
                  <p class="text-sm">{{$product->category_name}} </p>
                </td>

                <td class="with-id-columns">
                  <p class="text-sm">{{$product->total_quantity}} </p>
                </td>

                <td class="with-id-columns">
                  <p class="text-sm">{{$product->quantity ? $product->quantity : 0}}</p>
                </td>

                <td class="with-id-columns">
                  <p class="text-sm">{{($product->total_quantity - $product->quantity) > 0 ? ($product->total_quantity - $product->quantity) : 0}}</p>
                </td>

                <td class="flex flex-col">
                  <p class="font-bold text-sm">{{$product->name}} </p>
                </td>
            

              </tr>
              
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>