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
                <th>Email</th>
                <th>Empresa</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
    
                @foreach ($users as $item)
                <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">

                  <td class="with-id-columns"><p>{{$item->id}}</p></td>
                  <td class="with-actions-columns">
                    <div class="actions">
                      <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                        <x-sistem.buttons.delete-text wire:click="$dispatch('deleteUser', {{$item->id}})"
                          wire:loading.attr="disabled" />
                    </div>
                  </td>   

                  <td><p>{{$item->lastname}}, {{$item->name}}</p></td>

                  <td><p>{{$item->email}}</p></td>
                  <td><p>{{$item->company->name}}</p></td>

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