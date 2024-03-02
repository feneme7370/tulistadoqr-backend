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
                <th>Precio</th>
                <th>Niveles</th>
                <th>Categorias</th>
                <th>Productos</th>
                <th>Usuarios</th>
                <th>Etiquetas</th>
                <th>Sugerencias</th>
                <th>Lista</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
    
                @foreach ($memberships as $item)
                <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">
                  
                  <td class="with-id-columns">
                    <p>{{$item->id}}</p>
                  </td>

                  <td class="with-actions-columns">
                    <div class="actions">
                      <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                        <x-sistem.buttons.delete-text wire:click="$dispatch('deleteMembership', {{$item->id}})"
                          wire:loading.attr="disabled" />
                    </div>
                  </td>

                  <td><p>{{$item->name}}</p></td>
                  <td><p>{{$item->price}}</p></td>
                  <td><p>{{$item->level}}</p></td>
                  <td><p>{{$item->category}}</p></td>
                  <td><p>{{$item->product}}</p></td>
                  <td><p>{{$item->user}}</p></td>
                  <td><p>{{$item->tag}}</p></td>
                  <td><p>{{$item->suggestion}}</p></td>
                  <td><p>{{$item->list_product ? 'Si' : 'No'}}</p></td>

                  <td class="with-status-columns">
                    <span class="line-clamp-2 {{$item->status == '1' ? 't_badge-green' : 't_badge-red'}}">
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