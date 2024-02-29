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
              <th>Guard Name</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($roles as $item)
            <tr>

              <td class="with-id-columns">
                <p>{{$item->id}}</p>
              </td>
              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  {{-- <x-sistem.buttons.delete-text wire:click="openDeleteModal({{$item->id}})"
                    wire:loading.attr="disabled" /> --}}
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteRole', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td>
                <p>{{$item->name}}</p>
              </td>
              <td>
                <p>{{$item->guard_name}}</p>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->

  </div>