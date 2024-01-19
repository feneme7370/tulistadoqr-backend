<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Sugerencias">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- input buscador y filtro de activos --}}
    <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center mb-5">
        <form {{-- method="POST" --}} class="grid gap-3 mt-5 w-full md:w-1/2">

            <div>
                <x-sistem.forms.label-form for="product_id" value="{{ __('Listado de productos') }}" />
                <x-sistem.forms.select-form wire:model="product_id">
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </x-sistem.forms.select-form>
                <x-sistem.forms.input-error for="product_id" />
            </div>

        </form>
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

    {{-- listado --}}
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Producto</th>
                <th class="px-4 py-3">Creado por</th>
                <th class="px-4 py-3">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
    
                @foreach ($suggesteds as $item)
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3 text-sm">
                    {{$item->id}}
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center text-sm">
    
                      <!-- Avatar with inset shadow -->
                      {{-- <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                        <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy">
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                      </div> --}}
    
                      <div>
                        <p class="font-semibold">{{$item->product->name}}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                          {{$item->user->name}}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-xs">
                    <p class="font-semibold">{{$item->user->lastname}}, {{$item->user->name}}</p>
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                      <x-sistem.buttons.delete-text wire:click="deleteSuggestion({{$item->id}})"
                        wire:loading.attr="disabled" />
                    </div>
                  </td>
                </tr>
                @endforeach
    
            </tbody>
          </table>
        </div>
      </div>

    {{-- Paginacion --}}
    <div class="mt-4">
        {{ $suggesteds->onEachSide(1)->links() }}
    </div>

</div>