<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Sugerencias">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
      <p>Agregue productos sugeridos, estos apareceran tambien en una seccion aparte del menu digital. Puede poner productos en oferta, platos del dia, etc.</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    <div class="p-2 mb-1 flex justify-between items-center flex-col md:flex-row bg-white rounded-lg shadow-md gap-1">
      
      {{-- barra de select --}}
      <div class="w-full">
          <x-sistem.forms.select-form wire:model="product_id">
              @foreach ($products as $product)
                  <option value="{{$product->id}}">{{$product->name}}</option>
              @endforeach
          </x-sistem.forms.select-form>
          <x-sistem.forms.input-error for="product_id" />
      </div>

      {{-- boton de agregar --}}
      <div class="mr-2 flex gap-2 justify-center items-end md:justify-end w-full">
        <x-sistem.buttons.primary-btn
            title="Agregar"
            wire:click="save" 
            wire:loading.attr="disabled" 
            >
            @slot('icon')
            <x-sistem.icons.for-icons-app icon="plus" class="w-6 h-6"/>
            @endslot
        </x-sistem.buttons.primary-btn>
      </div>

    </div>

    {{-- listado --}}
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
                  <td class="with-id-columns"><p>{{$item->id}}</p></td>
                  
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

    {{-- Paginacion --}}
    <div class="mt-2">
        {{ $suggestions->onEachSide(1)->links() }}
    </div>

</div>