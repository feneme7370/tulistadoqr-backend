<div class="mx-auto">
    <!-- Ejemplo de una tarjeta -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="t_table">
                <thead>
                    <tr>
                        <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} ID</th>
                        <th wire:click="orderTable('id')">{{ $sortBy === 'id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Check</th>
                        <th wire:click="orderTable('name')">{{ $sortBy === 'name' ? ($sortAsc === true ? '↑' : '↓') : '' }} Imagen</th>
                        <th wire:click="orderTable('name')">{{ $sortBy === 'name' ? ($sortAsc === true ? '↑' : '↓') : '' }} Productos</th>
                        <th wire:click="orderTable('price_original')">{{ $sortBy === 'price_original' ? ($sortAsc === true ? '↑' : '↓') : '' }} Precio</th>
                        <th wire:click="orderTable('price_seller')">{{ $sortBy === 'price_seller' ? ($sortAsc === true ? '↑' : '↓') : '' }} Precio Oferta</th>
                        <th wire:click="orderTable('cost')">{{ $sortBy === 'cost' ? ($sortAsc === true ? '↑' : '↓') : '' }} Costo</th>
                        <th wire:click="orderTable('category_id')">{{ $sortBy === 'category_id' ? ($sortAsc === true ? '↑' : '↓') : '' }} Categoria</th>
                        <th wire:click="orderTable('status')">{{ $sortBy === 'status' ? ($sortAsc === true ? '↑' : '↓') : '' }} Estado</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $item)
                    <tr class="{{ $item->status == '1' ? '' : 't_tr-inactive' }}">
                        
                        <td class="with-id-columns"><p>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</p></td>

                        <td><x-sistem.forms.checkbox-form type="checkbox" wire:model="productsChecked" value="{{ $item->id }}" /></td>

                        <td class="with-image-columns">
                            <x-sistem.lightbox.img-tumb-lightbox 
                                :uri="$item->image_hero_uri" 
                                :name="$item->image_hero"    
                            />
                          </td>

                        <td class="text-center"><p>{{$item->name}}</p></td>

                        <td class="text-center text-orange-800"><p>{{number_format($item->price_original, 2,",",".")}}</p></td>
                        <td class="text-center text-green-800 font-bold"><p>{{number_format($item->price_seller, 2,",",".")}}</p></td>
                        <td class="text-center text-blue-800 font-bold"><p>{{number_format($item->cost, 2,",",".")}}</p></td>

                        <td class="text-center"><p>{{$item->category->level->name}} / {{$item->category->name}}</p></td>                            

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
</div>