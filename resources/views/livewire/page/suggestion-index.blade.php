<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Sugerencias">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- input buscador y filtro de activos --}}
    <div class="p-2 mb-1 flex justify-between items-center flex-col md:flex-row bg-white rounded-lg shadow-md gap-1 dark:bg-gray-800">
      
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
            autofocus>
            @slot('icon')
                <x-sistem.icons.hi-plus-circle/>
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
                <th>Producto</th>
              </tr>
            </thead>
            <tbody>
    
                @foreach ($suggestions as $item)
                <tr wire:key="field-suggestion-{{ $item->id }}">
                  <td class="text-center"><p>{{$item->id}}</p></td>
                  
                  <td>
                    <div class="actions">
                      <x-sistem.buttons.delete-text wire:click="deleteSuggestion({{$item->id}})"
                        wire:loading.attr="disabled" />
                    </div>
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