<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="t_table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Acciones</th>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Creado por</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($levels as $item)
            <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">

              <td class="with-id-columns">
                <p>{{$item->id}}</p>
              </td>
              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                    wire:loading.attr="disabled" />
                  <x-sistem.buttons.delete-text wire:click="$dispatch('deleteLevel', {{$item->id}})"
                    wire:loading.attr="disabled" />
                </div>
              </td>

              <td class="with-image-columns">
                <x-sistem.lightbox.img-tumb-lightbox :uri="$item->image_hero_uri" :name="$item->image_hero" />
              </td>

              <td>
                <p>{{$item->name}}</p>
              </td>
              <td>
                <p>{{$item->description}}</p>
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