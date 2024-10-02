<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Orden</th>
              <th>Precio</th>
              <th>Productos</th>
              <th>Creado por</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($orders as $item)
            <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">

              <td class="with-id-columns">
                <p>{{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}</p>
              </td>

              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.view-text wire:click="viewActionModal({{ $item->id }})" wire:loading.attr="disabled" />
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteOrder', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td>
                <p><a class="hover:underline" href="{{ route('orders.index', ['l' => $item->id]) }}"> {{$item->name}} </a> </p>
              </td>

              <td class="text-center">
                <p>$ {{number_format($item->total_price, 0,",",".")}}</p>
              </td>
              
              <td class="text-center">
                <p>{{$item->total_products}}</p>
              </td>

              <td>
                <p>{{$item->user->lastname}}, {{$item->user->name}}</p>
              </td>

              <td class="with-status-columns">
                <span
                  class="line-clamp-2 {{$item->status == '1' ? 't_badge-green' : 't_badge-red'}}">
                  {{$item->status == '1' ? 'Activo' : 'Inactivo'}}
                </span>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>