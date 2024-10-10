<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Fecha</th>
              <th>Tipo</th>
              <th>Nombre</th>
              <th>Producto</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($stocks as $item)
            <tr>

              <td class="with-id-columns">
                <p>{{ ($stocks->currentPage() - 1) * $stocks->perPage() + $loop->iteration }}</p>
              </td>

              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.view-text wire:click="viewActionModal({{ $item->id }})" wire:loading.attr="disabled" />
                  {{-- <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" /> --}}
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteStock', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td>
                <p> {{$item->date}} </p>
              </td>
              <td>
                <p> {{$item->type_stock->name}} </p>
              </td>
              <td>
                <p> {{$item->name}} </p>
              </td>
              <td>
                <p> {{$item->product->name}} </p>
              </td>
              <td>
                <p> {{$item->quantity}} </p>
              </td>


            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>