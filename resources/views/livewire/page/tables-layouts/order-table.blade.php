<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Datos</th>
              <th>Condicion</th>
              {{-- <th>Creado por</th> --}}
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($orders as $item)
            <tr class="{{ $item->status == '0' ? '' : 't_tr-active' }}">

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

              <td class="flex flex-col">
                <p class="font-bold text-lg">{{$item->customer->lastname}}, {{$item->customer->name}} <span class="text-xs italic">({{ $item->client }})</span></p>
                <p class="font-bold text-sm">Entrega: <span class="font-normal italic">{{$item->date}}</span> </p>
                
                <div>
                  <p>{{$item->total_products}} Un. | $ {{number_format($item->total_price, 0,",",".")}}</p>
                </div>
              </td>


              <td class="with-conditions-columns">
                <span
                  wire:click='toggleOrderConditions({{ $item->id }}, "is_maked")'
                  class="line-clamp-2 {{$item->is_maked == '1' ? 't_badge-green' : 't_badge-red'}}">
                  {{$item->is_maked == '1' ? 'En Stock' : 'Sin Stock'}}
                </span>
                <span
                wire:click='toggleOrderConditions({{ $item->id }}, "is_paid")'
                  class="line-clamp-2 {{$item->is_paid == '1' ? 't_badge-green' : 't_badge-red'}}">
                  {{$item->is_paid == '1' ? 'Pagado' : 'Sin pagar'}}
                </span>
                <span
                wire:click='toggleOrderConditions({{ $item->id }}, "is_delivered")'
                  class="line-clamp-2 {{$item->is_delivered == '1' ? 't_badge-green' : 't_badge-red'}}">
                  {{$item->is_delivered == '1' ? 'Entregado' : 'Sin entregar'}}
                </span>
              </td>

              {{-- <td>
                <p>{{$item->user->lastname}}, {{$item->user->name}}</p>
              </td> --}}

              <td class="with-conditions-columns">
                <span
                wire:click='toggleOrderStatus({{ $item->id }})'
                  class="line-clamp-2 {{$item->status == '1' ? 't_badge-green' : 't_badge-red'}}">
                  {{$item->status == '1' ? 'Completado' : 'Incompleto'}}
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