<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->

    <div class="overflow-hidden rounded-sm shadow-xs">
        <div class="overflow-x-auto">
          <table class="t_table">
            <thead>
              <tr>
                <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} ID</th>
                <th wire:click="orderTable('name')">{{ $sortBy === 'name' ? ($sortAsc === true ? '↑' : '↓') : '' }} Acciones</th>
                <th wire:click="orderTable('name')">{{ $sortBy === 'name' ? ($sortAsc === true ? '↑' : '↓') : '' }} Imagen</th>
                <th wire:click="orderTable('name')">{{ $sortBy === 'name' ? ($sortAsc === true ? '↑' : '↓') : '' }} Nombre</th>
                <th wire:click="orderTable('level_id')">{{ $sortBy === 'level_id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Categoria General</th>
                <th wire:click="orderTable('status')">{{ $sortBy === 'level_id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Estado</th>
              </tr>
            </thead>
            <tbody>
    
                @foreach ($categories as $item)
                <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">

                  <td class="with-id-columns"><p>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</p></td>

                  <td class="with-actions-columns">
                    <div class="actions">
                      <x-sistem.buttons.view-text wire:click="viewActionModal({{ $item->id }})" wire:loading.attr="disabled" />
                      <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})" wire:loading.attr="disabled" />
                      <x-sistem.buttons.delete-text wire:click="$dispatch('deleteCategory', {{$item->id}})"
                      wire:loading.attr="disabled" />
                    </div>
                  </td>

                  <td class="with-image-columns">
                    <x-sistem.lightbox.img-tumb-lightbox 
                        :uri="$item->image_hero_uri" 
                        :name="$item->image_hero"    
                    />
                  </td>

                  <td><p><a class="hover:underline" href="{{ route('products.index', ['c' => $item->id]) }}"> {{$item->name}} </a> </p></td>

                  {{-- <td><p>{{ $item->description }}</p></td> --}}
                
                  <td><p>{{$item->level->name}}</p></td>

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