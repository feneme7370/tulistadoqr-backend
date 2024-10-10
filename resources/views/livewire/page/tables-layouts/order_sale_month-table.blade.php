<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>Mes</th>
              <th>Total Ventas</th>
              <th>Total Costos</th>
              <th>Total Órdenes</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($sales_by_orders as $month => $data)
              <tr>

                <td class="with-id-columns">
                  <p><x-traductors.month format_month="short" month="{{ $month }}" /></p>
                </td>
                

                <td class="with-id-columns">
                  <p class="text-sm t_badge-green">${{ number_format($data['sum_sales'], 2,",",".") }} </p>
                  <p class="text-sm">${{ $$data }} </p>
                </td>

                <td class="with-id-columns">
                  <p class="text-sm t_badge-red">${{number_format($data['sum_costs'], 2,",",".")}} </p>
                </td>

                <td class="with-id-columns">
                  <p class="text-sm t_badge-blue font-bold">{{$data['count_orders']}} </p>
                </td>


              </tr>
              
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>