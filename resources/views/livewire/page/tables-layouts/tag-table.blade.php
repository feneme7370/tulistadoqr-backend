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

          @foreach ($tags as $item)
          <tr>

            <td class="with-id-columns">
              <p>{{ ($tags->currentPage() - 1) * $tags->perPage() + $loop->iteration }}</p>
            </td>
            <td class="with-actions-columns">
              <div class="actions">
                  <button class="text-xs font-bold hover:text-blue-100 text-blue-200 bg-blue-800 p-1 rounded-lg" wire:click="editActionModal({{$item->id}})">Editar</button>
                  <button class="text-xs font-bold hover:text-red-100 text-red-200 bg-red-800 p-1 rounded-lg" wire:click="$dispatch('deleteTag', {{$item->id}})">Borrar</button>
              </div>
            </td>


            <td>
              <p> {{$item->name}}  </p>
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>

  <!-- Agrega más tarjetas aquí -->

</div>