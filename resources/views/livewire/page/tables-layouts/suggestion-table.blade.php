<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <table class="t_table">
        <thead>
          <tr>
            <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} ID</th>
            <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Acciones</th>
            <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Imagen</th>
            <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Producto</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($suggestions as $item)
            <tr>
              <td class="with-id-columns"><p>{{ ($suggestions->currentPage() - 1) * $suggestions->perPage() + $loop->iteration }}</p></td>
              
              <td class="with-actions-columns">
                <div class="actions">
                  <button type="button" class="text-xs font-bold hover:text-red-100 text-red-200 bg-red-800 p-1 rounded-lg" wire:click="deleteSuggestion({{$item->id}})">Borrar</button>
                </div>
              </td>

              <td class="with-image-columns">
                <x-sistem.lightbox.img-tumb-lightbox 
                    :uri="$item->product->image_hero_uri" 
                    :name="$item->product->image_hero"    
                />
              </td>
              
              <td class="text-center"><p>{{$item->product->name}}</p></td>

            </tr>
            @endforeach

        </tbody>
      </table>
    </div>
</div>