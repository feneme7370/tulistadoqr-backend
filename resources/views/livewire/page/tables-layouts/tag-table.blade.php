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
            </tr>
          </thead>
          <tbody>

            @foreach($tags as $item)
              <tr>

                <td class="with-id-columns"><p>{{ ($tags->currentPage() - 1) * $tags->perPage() + $loop->iteration }}</p></td>

                <td class="with-actions-columns">
                  <div class="actions">
                    <button class="text-xs hover:text-blue-500 text-blue-400" wire:click="editActionModal({{$item->id}})">Editar</button>
                    <button class="text-xs hover:text-red-500 text-red-400 bg" wire:click="$dispatch('deleteTag', {{$item->id}})">Borrar</button>
                    {{-- <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                      wire:loading.attr="disabled"></x-sistem.buttons.edit-text>
                    <x-sistem.buttons.delete-text wire:click="$dispatch('deleteTag', {{$item->id}})"
                      wire:loading.attr="disabled" ></x-sistem.buttons.delete-text> --}}
                  </div>
                </td>

                <td><p>{{$item->name}}</p></td>

              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>

    <!-- Agrega más tarjetas aquí -->
</div>