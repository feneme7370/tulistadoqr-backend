<x-sistem.modal.dialog-modal wire:model="showActionModal">
  <x-slot name="title">
      {{ __('Formulario para ' . ($order ? 'editar' : 'agregar') . ' datos') }}
  </x-slot> 

  <x-slot name="content">

    {{-- form datos --}}
    <x-sistem.forms.form-section submit="save">
      <x-slot name="title">
        {{ __('Datos') }}
      </x-slot>

      <x-slot name="description">
        {{ __('Cree una orden para un cliente, asigando los productos.') }}
      </x-slot>

      <x-slot name="form">
        <div class="grid gap-2 w-full">

          <div>
            <x-sistem.forms.label-form for="date" value="{{ __('Fecha de vencimiento') }}" />
            <x-sistem.forms.input-form id="date" type="date" placeholder="{{ __('Fecha de vencimiento') }}" wire:model="date" />
            <x-sistem.forms.input-error for="date" />
          </div>
  
          <div>
            <x-sistem.forms.label-form for="client_id" value="{{ __('Cliente') }}" />
            <x-sistem.forms.select-form wire:model="client_id" id="client_id">
                @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->lastname}}, {{$client->name}}</option>
                @endforeach
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="client_id" />
          </div>

          <div>
            <x-sistem.forms.label-form for="client" value="{{ __('Apodo') }}" />
            <x-sistem.forms.input-form id="client" type="text" placeholder="{{ __('Apodo') }}" wire:model="client" />
            <x-sistem.forms.input-error for="client" />
          </div>

          <div>
            <x-sistem.forms.label-form for="adress" value="{{ __('Direccion') }}" />
            <x-sistem.forms.input-form id="adress" type="text" placeholder="{{ __('Direccion') }}" wire:model="adress" />
            <x-sistem.forms.input-error for="adress" />
          </div>
  
          <div>
            <x-sistem.forms.label-form for="shipping_methods_id" value="{{ __('Tipo de pedido') }}" />
            <x-sistem.forms.select-form wire:model="shipping_methods_id" id="shipping_methods_id">
                @foreach ($shipped_methods as $shipped_method)
                    <option value="{{$shipped_method->id}}">{{$shipped_method->name}}</option>
                @endforeach
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="shipping_methods_id" />
          </div>

          <div>
            <x-sistem.forms.label-form for="description" value="{{ __('Descripcion') }}" />
            <x-sistem.forms.textarea-form id="description" placeholder="{{ __('Ingresar una breve descripcion') }}"
              wire:model="description" />
            <x-sistem.forms.input-error for="description" />
          </div>
  
          <div>
            <label for="is_maked" class="flex items-center">
              <x-sistem.forms.checkbox-form id="is_maked" wire:model="is_maked" />
              <br><span class="ml-2 text-sm text-gray-600">{{ __('Producto Hecho') }}</span>
            </label>
          </div>

          <div>
            <label for="is_paid" class="flex items-center">
              <x-sistem.forms.checkbox-form id="is_paid" wire:model="is_paid" />
              <br><span class="ml-2 text-sm text-gray-600">{{ __('Producto Pagado') }}</span>
            </label>
          </div>
          
          <div>
            <label for="is_delivered" class="flex items-center">
              <x-sistem.forms.checkbox-form id="is_delivered" wire:model="is_delivered" />
              <br><span class="ml-2 text-sm text-gray-600">{{ __('Producto Entregado') }}</span>
            </label>
          </div>

          <div>
            <label for="status" class="flex items-center">
              <x-sistem.forms.checkbox-form id="status" wire:model="status" />
              <br><span class="ml-2 text-sm text-gray-600">{{ __('Estado') }}</span>
            </label>
          </div>

        </div>
      </x-slot>

      <x-slot name="actions">
      </x-slot>

    </x-sistem.forms.form-section>

    {{-- form products --}}
    <x-sistem.forms.form-section submit="save">
      <x-slot name="title">
        {{ __('Productos') }}
      </x-slot>

      <x-slot name="description">
        {{ __('Seleccione los productos que quiere asignar a la orden.') }}
      </x-slot>

      <x-slot name="form">
        <div class="grid gap-2 w-full">
          
          {{-- @foreach ($products_selected as $index => $product_selected)
            <div>
              <x-sistem.forms.label-form for="product_selected.{{ $index }}.product_id" value="{{ __('Seleccionar producto') }}" />
              <x-sistem.forms.select-form wire:model="product_selected.{{ $index }}.product_id" id="product_selected.{{ $index }}.product_id">
                @foreach ($available_products as $available_product)
                <option value="{{$available_product->id}}">{{$available_product->name}}</option>
                  @endforeach
              </x-sistem.forms.select-form>
              <x-sistem.forms.input-error for="product_selected.{{ $index }}.product_id" />
            </div>
              
            <div>
              <x-sistem.forms.label-form for="product_selected.{{ $index }}.quantity" value="{{ __('Cantidad') }}" />
              <x-sistem.forms.input-form id="product_selected.{{ $index }}.quantity" type="text" placeholder="{{ __('Cantidad') }}" wire:model="product_selected.{{ $index }}.quantity" />
              <x-sistem.forms.input-error for="product_selected.{{ $index }}.quantity" />
            </div>

            <div>
              <x-sistem.forms.label-form for="product_selected.{{ $index }}.discount" value="{{ __('Descuento') }}" />
              <x-sistem.forms.input-form id="product_selected.{{ $index }}.discount" type="text" placeholder="{{ __('Descuento') }}" wire:model="product_selected.{{ $index }}.discount" />
              <x-sistem.forms.input-error for="product_selected.{{ $index }}.discount" />
            </div>
            <x-sistem.buttons.normal-btn wire:click="removeProduct({{ $index }})" wire:loading.attr="disabled"
            title="Borrar" />
          @endforeach --}}
          <div>
            <x-sistem.forms.label-form for="product_selected.product_id" value="{{ __('Seleccionar producto') }}" />
            <x-sistem.forms.select-form wire:model="product_selected.product_id" id="product_selected.product_id">
              
              @foreach ($categories as $category)
                <optgroup label="{{$category->name}}">

                  @foreach ($available_products as $available_product)
                    @if ($available_product->category->name == $category->name)
                    <option value="{{$available_product->id}}">{{$available_product->name}}</option>
                    @endif
                  @endforeach
                  
                </optgroup>
              @endforeach
            
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="product_selected.product_id" />
          </div>

          <div class="flex justify-between items-center gap-1">

            <div>
              <x-sistem.forms.label-form for="product_selected.quantity" value="{{ __('Cantidad') }}" />
              <x-sistem.forms.input-form id="product_selected.quantity" type="text" placeholder="{{ __('Cantidad') }}" wire:model="product_selected.quantity" />
              <x-sistem.forms.input-error for="product_selected.quantity" />
            </div>
  
            <div>
              <x-sistem.forms.label-form for="product_selected.discount" value="{{ __('Descuento') }}" />
              <x-sistem.forms.input-form id="product_selected.discount" type="text" placeholder="{{ __('Descuento') }}" wire:model="product_selected.discount" />
              <x-sistem.forms.input-error for="product_selected.discount" />
            </div>
          </div>

            
          <x-sistem.buttons.normal-btn wire:click="addProduct()" wire:loading.attr="disabled"
          title="Agregar" />

          <div class="w-full md:max-w-sm bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white p-2">Productos</h5>
                <span class="font-bold text-sm">
                  ${{ number_format($temporalTotalPrice, 0,",",".") }}
                </span>
            </div>

            <hr class="border-primary-300 mt-1 w-10/12 mx-auto">

            <!-- listado de productos a comprar -->
            @foreach ($products_selected as $index => $product)
            
              <div class="flex items-center justify-between gap-1 my-2 p-1">

                  <!-- cantidad de producto y nombres -->
                  <div>
                      <div class="flex items-center gap-2">
                          <span class="text-gray-700 text-base font-bold">({{ $product['quantity'] }})</span>
                          <span class="text-gray-800 text-sm font-bold">{{ $product['dates']['name'] }}</span>
                      </div>
                      <div class="flex items-center justify-start gap-2">
                  
                          <span class="text-gray-700 text-xs font-medium">c/u:${{ number_format($product['price'], 0,",",".") }}</span>
                          <span class="text-gray-700 text-xs font-medium">Descuento: {{ $product['discount'] }} %</span>

                      </div>
                  </div>
          
                  <!-- ver precio total del producto y botones de sumar y restar -->
                  <div class="flex items-center justify-center flex-col gap-1">
                      <x-sistem.buttons.normal-btn wire:click="removeProduct({{ $index }})" wire:loading.attr="disabled"
                      title="X" class="text-center">
                      {{-- <x-sistem.icons.for-icons-app icon="trash" class="h-2 w-2"/> --}}
                      </x-sistem.buttons.normal-btn>
                      <span class="text-gray-700 text-sm font-bold">${{ number_format($product['total_price'], 0,",",".") }}</span>
                  </div>
              </div>

              <hr class="border-primary-300 mb-1 w-10/12 mx-auto">
            
            @endforeach
            


          </div>

        </div>

      </x-slot>

      <x-slot name="actions">
        <x-sistem.forms.validation-errors class="mb-4" />
        <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
        <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
          title="{{$order ? 'Actualizar' : 'Guardar'}}">
          <div wire:loading>
            <x-sistem.spinners.loading-spinner-btn />
          </div>
        </x-sistem.buttons.primary-btn>
      
      </x-slot>

    </x-sistem.forms.form-section>

    <x-sistem.menus.section-border />

  </x-slot>

  <x-slot name="footer">
  </x-slot>
</x-sistem.modal.dialog-modal>


<x-sistem.modal.dialog-modal wire:model="showViewModal">
  <x-slot name="title">
      {{ __('Ver datos') }}
  </x-slot> 

  <x-slot name="content">

    <div class="grid gap-3 p-1 w-full">


      <dl class="w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
        <div class="flex flex-col pb-1">
            <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Nombre de pedido:</dt>
            <dd class="text-xs font-semibold">{{ $order->name ?? ''}}</dd>
        </div>


        <div class="grid grid-cols-2 gap-1">
          <div class="flex flex-col py-1">
              <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Productos:</dt>
              <dd class="text-xs font-semibold">{{ $order->total_products ?? ''}}</dd>
          </div>
          <div class="flex flex-col py-1">
              <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Monto:</dt>
              <dd class="text-xs font-semibold">$ {{ number_format($order->total_price ?? 0, 0,",",".") }}</dd>
          </div>
        </div>

        <div class="grid grid-cols-2 gap-1">

          <div>
            <div class="flex flex-col py-1">
                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Nombre del cliente:</dt>
                <dd class="text-xs font-semibold">{{ $order->client->name ?? ''}}</dd>
            </div>

            <div class="flex flex-col py-1">
                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Apodo:</dt>
                <dd class="text-xs font-semibold">{{ $order->client ?? ''}}</dd>
            </div>

            <div class="flex flex-col py-1">
                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Direccion:</dt>
                <dd class="text-xs font-semibold">{{ $order->adress ?? ''}}</dd>
            </div>
          </div>
          
          <div>
            <div class="flex flex-col py-1">
              <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Fecha</dt>
              <dd class="text-xs font-semibold">{{ $order->date ?? ''}}</dd>
            </div>

            <div class="flex flex-col py-1">
              <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Forma de envio:</dt>
              <dd class="text-xs font-semibold">{{ $order->shipping_method->name ?? ''}}</dd>
            </div>
          </div>

        </div>

        <div class="flex flex-col py-1">
          <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Descripcion:</dt>
          <dd class="text-xs font-semibold whitespace-pre-wrap">{{ $order->description ?? ''}}</dd>
        </div>

      </dl>



      <div class="w-full bg-white border border-gray-200 rounded-lg p-1 shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

        <div class="flex items-center justify-between mb-1">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white p-2">Productos</h5>
            <span class="font-bold text-sm">
              ${{ number_format($temporalTotalPrice, 0,",",".") }}
            </span>
        </div>
        {{-- <hr class="border-primary-300 mt-1 w-10/12 mx-auto"> --}}

        <!-- listado de productos a comprar -->
        @foreach ($products_selected as $index => $product)

          <hr class="border-primary-300 mb-1 w-10/12 mx-auto">
        
          <div class="flex items-center justify-between gap-1 my-2">

              <!-- cantidad de producto y nombres -->
              <div>
                  <div class="flex items-center gap-2">
                      <span class="text-gray-700 text-base font-bold">({{ $product['quantity'] }})</span>
                      <span class="text-gray-800 text-sm font-bold">{{ $product['dates']['name'] }}</span>
                  </div>
                  <div class="flex items-center justify-start gap-2">
              
                      <span class="text-gray-700 text-xs font-medium">c/u:${{ number_format($product['price'], 0,",",".") }}</span>
                      <span class="text-gray-700 text-xs font-medium"> | Descuento: {{ $product['discount'] }} %</span>

                  </div>
              </div>

              <div class="flex items-center justify-center flex-col gap-1">
                <span class="text-gray-700 text-sm font-bold">${{ number_format($product['total_price'], 0,",",".") }}</span>
            </div>
      
          </div>

        
        @endforeach
      </div>

      <div  class="grid grid-cols-2 gap-1">
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Estado:</dt>
            <dd class="text-xs font-semibold whitespace-pre-wrap">{{ ($order->status ?? '') ? 'Activo' : 'Inactivo'}}</dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Hecho:</dt>
            <dd class="text-xs font-semibold whitespace-pre-wrap">{{ ($order->is_maked ?? '') ? 'En stock' : 'Sin Stock'}}</dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Pagado:</dt>
            <dd class="text-xs font-semibold whitespace-pre-wrap">{{ ($order->is_paid ?? '') ? 'Pagado' : 'Sin pagar'}}</dd>
        </div>
        <div class="flex flex-col pt-3">
            <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Entregado:</dt>
            <dd class="text-xs font-semibold whitespace-pre-wrap">{{ ($order->is_delivered ?? '') ? 'Entregado' : 'Sin entregar'}}</dd>
        </div>
      </div>

      <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Ultima modificacion por:</dt>
        <dd class="text-xs font-semibold whitespace-pre-wrap">{{ $order->user->lastname ?? ''}}, {{ $order->user->name ?? ''}}</dd>
      </div>
    </div>

  </x-slot>

  <x-slot name="footer">
  </x-slot>
</x-sistem.modal.dialog-modal>