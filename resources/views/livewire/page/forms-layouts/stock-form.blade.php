<x-sistem.modal.dialog-modal wire:model="showActionModal">
  <x-slot name="title">
      {{ __('Formulario para ' . ($stock ? 'editar' : 'agregar') . ' datos') }}
  </x-slot> 

  <x-slot name="content">

    {{-- form datos --}}
    <x-sistem.forms.form-section submit="save">
      <x-slot name="title">
        {{ __('Datos') }}
      </x-slot>

      <x-slot name="description">
        {{ __('Agregue los datos del stock.') }}
      </x-slot>

      <x-slot name="form">
        <div class="grid gap-2 w-full">

          <div>
            <x-sistem.forms.label-form for="date" value="{{ __('Fecha') }}" />
            <x-sistem.forms.input-date-form 
            wire:model="date" 
            type="date" 
            placeholder="Fecha" 
            class="w-full" />
            <x-sistem.forms.input-error for="date" />
          </div>

          <div>
            <x-sistem.forms.label-form for="quantity" value="{{ __('Cantidad') }}" />
            <x-sistem.forms.input-form id="quantity" type="numeric" placeholder="{{ __('Cantidad') }}" wire:model="quantity" />
            <x-sistem.forms.input-error for="quantity" />
          </div>

          <div>
            <x-sistem.forms.label-form for="product_id" value="{{ __('Seleccionar producto') }}" />
            <x-sistem.forms.select-form wire:model="product_id" id="product_id">
              
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
            <x-sistem.forms.input-error for="product_id" />
          </div>

          <div>
            <x-sistem.forms.label-form for="type_stock_id" value="{{ __('Seleccionar producto') }}" />
            <x-sistem.forms.select-form wire:model="type_stock_id" id="type_stock_id">

                  @foreach ($type_stocks as $type_stock)
                    <option value="{{$type_stock->id}}">{{$type_stock->name}}</option>
                  @endforeach
            
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="type_stock_id" />
          </div>

          <x-sistem.forms.validation-errors class="mb-4" />
        </div>
      </x-slot>

      <x-slot name="actions">

        <x-sistem.buttons.normal-btn wire:click="$set('showActionModal', false)" wire:loading.attr="disabled"
        title="Cancelar" />
        <x-sistem.buttons.primary-btn wire:click="save" wire:loading.class="opacity-50" wire:loading.attr="disabled"
          title="{{$stock ? 'Actualizar' : 'Guardar'}}">
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

    <div class="grid gap-3 p-1">


      <p class="text-gray-900 font-bold text-base uppercase mr-3">Fecha: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->date ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Nombre: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->name ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Cantidad: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->quantity ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Tipo de movimiento: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->type_stock->name ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Producto: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->product->name ?? ''}}</span>
      </p>

      <p class="text-gray-900 font-bold text-base uppercase mr-3">Ultima modificacion por: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->user->lastname ?? ''}}, {{ $stock->user->name ?? ''}}</span>
      </p>
      <p class="text-gray-900 font-bold text-base uppercase mr-3">Empresa: 
        <br><span class="text-gray-700 italic text-sm normal-case">{{ $stock->company->name ?? ''}}</span>
      </p>
    </div>

  </x-slot>

  <x-slot name="footer">
  </x-slot>
</x-sistem.modal.dialog-modal>