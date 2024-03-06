<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
      <table class="t_table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Acciones</th>
            <th>Imagen</th>
            <th>Producto</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($suggestions as $item)
            <tr>
              <td class="with-id-columns"><p>{{ ($suggestions->currentPage() - 1) * $suggestions->perPage() + $loop->iteration }}</p></td>
              
              <td class="with-actions-columns">
                <div class="actions">
                  <x-sistem.buttons.delete-text wire:click="deleteSuggestion({{$item->id}})"
                    wire:loading.attr="disabled" />
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