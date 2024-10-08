<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Nombre</th>
              <th>Direccion</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($clients as $item)
            <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">

              <td class="with-id-columns">
                <p>{{ ($clients->currentPage() - 1) * $clients->perPage() + $loop->iteration }}</p>
              </td>

              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.view-text wire:click="viewActionModal({{ $item->id }})" wire:loading.attr="disabled" />
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteClient', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td>
                <p> {{$item->lastname}}, {{$item->name}} </p>
              </td>
              <td>
                <p> {{$item->adress}} </p>
              </td>


            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>