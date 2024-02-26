<div>
    {{-- mensaje de alerta --}}
    <x-sistem.notifications.alerts :messageSuccess="session('messageSuccess')"
        :messageError="session('messageError')" 
    />

    {{-- titulo y boton --}}
    <x-sistem.menus.title-and-btn title="Productos">
        <div></div>
    </x-sistem.menus.title-and-btn>

    {{-- texto informativo --}}
    <x-sistem.menus.text-info>
        <p>Puede cambiar el precio y precio de oferta de forma masiva por categoria.</p>
    </x-sistem.menus.text-info>

    {{-- input buscador y filtro de activos --}}
    {{-- <div class="flex flex-row flex-1 justify-evenly items-center gap-2 p-2"> --}}
    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div  class="w-full">
            <x-sistem.forms.label-form for="categorySearch" value="{{ __('Categoria') }}" />
            <x-sistem.forms.select-form wire:model.live="categorySearch" id="categorySearch">
                <option value=""> Todos </option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->level->name}} - {{$category->name}}</option>
                @endforeach
            </x-sistem.forms.select-form>
            <x-sistem.forms.input-error for="categorySearch" />
        </div>

        <div  class="w-1/4">
            <x-sistem.forms.label-form for="perPage" value="{{ __('Mostrar') }}" />
            <x-sistem.forms.select-form wire:model.live="perPage" id="perPage">
                <option value="10"> 10 </option>
                <option value="30"> 30 </option>
                <option value="50"> 50 </option>
                <option value="100"> 100 </option>
            </x-sistem.forms.select-form>
        </div>
    </x-sistem.filter.bg-input>

    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div class="w-full">
            <x-sistem.forms.input-form 
                wire:model.live.debounce.600ms="search" 
                type="search" 
                placeholder="Buscar por nombre o categoria" 
                class="w-full" />
        </div>
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="active" />Solo activos
        </div>
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="offers" />En oferta
        </div>
    </x-sistem.filter.bg-input>

    <x-sistem.filter.bg-input class="flex-row flex-1">
    
        <div class="w-full">
            <div>
                <x-sistem.forms.input-form 
                    wire:model="price_original"
                    placeholder="Precio original" 
                    class="w-full" />
            </div>
            <x-sistem.forms.input-error for="price_original" />
        </div>
        <div class="w-full">
            <div>
                <x-sistem.forms.input-form 
                    wire:model="price_seller" 
                    placeholder="Precio de oferta" 
                    class="w-full" />
            </div>
            <x-sistem.forms.input-error for="price_seller" />
        </div>
        
        <x-sistem.buttons.primary-btn 
        wire:click="save"
        wire:loading.class="opacity-50"  
        wire:loading.attr="disabled"
        title="Actualizar" >
        <div wire:loading>
            <x-sistem.spinners.loading-spinner-btn/>
        </div>
    </x-sistem.buttons.primary-btn> 
    </x-sistem.filter.bg-input>

    {{-- </div> --}}

    {{-- <x-sistem.filter.search-active placeholder="Buscar por nombre, nivel o categoria" /> --}}

    <x-sistem.spinners.loading-spinner wire:loading wire:target="search, level_search, categorySearch"/>

    {{-- listado --}}
    <div class="mx-auto">
        <!-- Ejemplo de una tarjeta -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="t_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Check</th>
                            <th>Imagen</th>
                            <th>Productos</th>
                            <th>Precio</th>
                            <th>Precio Oferta</th>
                            <th>Categoria</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $item)
                        <tr>
                            
                            <td class="with-id-columns"><p>{{$item->id}}</p></td>

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

                            <td class="text-center"><p>{{$item->category->level->name}} / {{$item->category->name}}</p></td>                            

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

    {{-- Paginacion --}}
    <div class="mt-2">
        {{-- {{ $products->onEachSide(1)->links('pagination::windmill-pagination') }} --}}
        {{ $products->onEachSide(1)->links() }}
    </div>

    @push('scripts')

    <script>
        Livewire.on('toastifyProduct', (mensaje) => {
        Toastify({
            text: mensaje,
            duration: 4000,
            // destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
            background: "#f0fdf4",
            color: "#166534",
            },
            onClick: function(){} // Callback after click
        }).showToast();
        })
    </script>
    @endpush
</div>