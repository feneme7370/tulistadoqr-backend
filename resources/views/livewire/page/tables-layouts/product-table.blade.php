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
                        <th>Productos</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th>Tags</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $item)
                    <tr>
                        
                        <td class="with-id-columns"><p>{{$item->id}}</p></td>
                        
                        <td class="with-actions-columns">
                            <div class="actions">
                                <x-sistem.buttons.edit-text wire:click="editActionModal({{$item->id}})"
                                    wire:loading.attr="disabled" />
                                <x-sistem.buttons.delete-text wire:click="$dispatch('deleteProduct', {{$item->id}})"
                                    wire:loading.attr="disabled" />
                            </div>
                        </td>

                        <td class="with-image-columns">
                            <x-sistem.lightbox.img-tumb-lightbox 
                                :uri="$item->image_hero_uri" 
                                :name="$item->image_hero"    
                            />
                          </td>

                        <td class="text-center"><p>{{$item->name}}</p></td>
                        
                        <td 
                            class="text-center"                                
                        ><p class="{{$item->price_seller ? 'text-green-800 font-bold' : 'text-orange-800'}}" >${{$item->price_seller ? number_format($item->price_seller, 2,",",".") : number_format($item->price_original, 2,",",".") }}</p>
                        </td>
                        
                        <td class="text-center"><p>{{$item->category->level->name}} / {{$item->category->name}}</p></td>
                        
                        <td class="text-center"><p>{{$item->tags->count()}}</p></td>

                        <td class="with-status-columns">
                            <span class="line-clamp-2 {{$item->status == '1' ? 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded' : 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded'}}">
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