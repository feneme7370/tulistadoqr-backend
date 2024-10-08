<?php

namespace App\Livewire\Page;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Page\Order;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Category;
use App\Models\Page\Client;
use Livewire\WithFileUploads;
use App\Models\Page\ShippingMethod;

class OrderIndex extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_order');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_order');}

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10, $date_start, $date_finish;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ], 'date_start' => [ 'as' => 'ds' ], 'date_finish' => [ 'as' => 'df' ]];
    }

    public function mount(){
        $this->date_start = Carbon::today()->addDays(-7)->toDateString();
        $this->date_finish = Carbon::today()->addDays(7)->toDateString();
    }
    
    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showViewModal = false;

    // propiedades del form
    public $name;
    public $date;
    public $client;
    public $adress;
    public $shipping_methods_id;
    public $type_send;
    public $description;
    public $is_maked;
    public $is_paid;
    public $is_delivered;

    public $status;
    public $client_id;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $order;

    // valores estaticos que van en columna de order
    public $total_price = 0;
    public $total_products = 0;
    public $total_cost = 0;

    // producto que se agregara al listado
    public $product_selected = ['product_id' => null, 'quantity' => 1, 'discount' => 0];
    
    // listado de arrays con cada producto
    public $products_selected = [];
    public $temporalTotalPrice = 0;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'date' => ['required', 'date'],
            'client' => ['required', 'string', 'min:1', 'max:255'],
            'adress' => ['required', 'string', 'min:1', 'max:255'],
            'shipping_methods_id' => ['required', 'numeric'],
            'description' => ['nullable', 'string', 'min:1', 'max:255'],
            
            'is_maked' => ['nullable', 'numeric'],
            'is_paid' => ['nullable', 'numeric'],
            'is_delivered' => ['nullable', 'numeric'],
            'status' => ['nullable', 'numeric'],
            
            'client_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],

            'product_selected.product_id' => ['nullable', 'numeric'],
            'product_selected.quantity' => ['required', 'integer', 'min:1'],
            'product_selected.discount' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
    // renombrar variables a castellano
    protected $validationAttributes = [
        'date' => 'fecha',
        'client' => 'nombre del cliente',
        'adress' => 'direccion',
        'shipping_methods_id' => 'forma de envio',
        'description' => 'descripcion',
        'is_maked' => 'hecho',
        'is_paid' => 'pagado',
        'is_delivered' => 'enviado',
        'status' => 'estado',
        'client_id' => 'cliente',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'product_selected' => 'producto seleccionado',
        'products_selected' => 'productos seleccionado',

    ];

    
    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['date', 'client', 'adress', 'shipping_methods_id', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'client_id', 'user_id', 'company_id', 'product_selected', 'products_selected', 'total_cost','total_price', 'total_products', 'temporalTotalPrice']);
    }

    // eliminar producto de la orden, en una posicion determinada
    public function removeProduct($index){
        unset($this->products_selected[$index]);
        $this->products_selected = array_values($this->products_selected);

        $this->reset('product_selected');

        $this->temporalTotalPrice = 0;

        foreach($this->products_selected as $product){
            $this->temporalTotalPrice += $product['total_price'];
        }
    }

    //agregar productos a la orden
    public function addProduct(){
        // agregar datos del producto
        $this->product_selected['dates'] = Product::find($this->product_selected['product_id']);

        // si estan los datos
        if($this->product_selected['dates']){
            
            // agregar precio con el descuento que viene de la pagina ya
            $this->product_selected['price'] = ($this->product_selected['dates']['price_original'] > $this->product_selected['dates']['price_seller'] && $this->product_selected['dates']['price_seller'] > 0) 
                ? $this->product_selected['dates']['price_seller']   
                : $this->product_selected['dates']['price_original'] ; 
            
            // agregar precio con descuento original y es la suma de cantidades, solo hasta guardar
            $this->product_selected['total_price'] = ($this->product_selected['dates']['price_original'] >          $this->product_selected['dates']['price_seller'] && $this->product_selected['dates']['price_seller'] > 0) 
                ? $this->product_selected['dates']['price_seller'] * (1- ($this->product_selected['discount']/100))  * $this->product_selected['quantity'] 
                : $this->product_selected['dates']['price_original'] * (1- ($this->product_selected['discount'] / 100))  * $this->product_selected['quantity']; 

            // agregar costos unitarios y totales
            $this->product_selected['cost'] = $this->product_selected['dates']['cost'];
            $this->product_selected['total_cost'] = $this->product_selected['dates']['cost'] * $this->product_selected['quantity'];
    
            // agregar array con id, cantidad y descuento unitario
            $this->products_selected[] = $this->product_selected;

            $this->reset('product_selected');

            $this->temporalTotalPrice = 0;

            foreach($this->products_selected as $product){
                $this->temporalTotalPrice += $product['total_price'];
            }

        }

    }


    // toggle
    public function toggleOrderConditions($id, $property){
        $order = Order::find($id);

        $this->$property = $order->$property;

        $this->$property = !$this->$property;

        $order->update($this->only([$property]));

        $order = null;
        $this->reset($property);
    }

    public function toggleOrderStatus($id){
        $this->order = Order::find($id);

        $this->is_maked = $this->order['is_maked'];
        $this->is_paid = $this->order['is_paid'];
        $this->is_delivered = $this->order['is_delivered'];
        $this->status = $this->order['status'];

        $this->status = !$this->status;
        
        if($this->status == '1' || $this->status == true){
            $this->is_maked = '1';
            $this->is_paid = '1';
            $this->is_delivered = '1';
        }
        $this->order->update($this->only(['is_maked', 'is_paid', 'is_delivered', 'status']));
        
        $this->reset(['order']);
        $this->resetProperties();       
    }
    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteOrderId'];
    public function deleteOrderId($id){
        $this->resetProperties();

        $this->order = Order::findOrFail($id);
        $this->authorize('delete', $this->order); 

        // comprobar si tiene productos asignados
        $this->order->delete();

        $this->resetProperties();
        $this->reset('order');

        $this->dispatch('toastrSuccess', 'Eliminado con exito');
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetProperties();
        $this->reset(['order']);

        $this->status = true;
        $this->showActionModal = true;
    }

    // cargar datos a editar de la orden
    public function preloadEditModal($item){
        $this->date = $item['date'];
        $this->client = $item['client'];
        $this->adress = $item['adress'];
        $this->shipping_methods_id = $item['shipping_methods_id'];
        $this->description = $item['description'];
        $this->is_maked = $item['is_maked'] == '1' ? true : false;
        $this->is_paid = $item['is_paid'] == '1' ? true : false;
        $this->is_delivered = $item['is_delivered'] == '1' ? true : false;
        $this->status = $item['status'] == '1' ? true : false;
        $this->client_id = $item['client_id'];
        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];

        // cargar datos de productos asociados a la orden
        foreach ($this->order->products as $product) {
    
            // pegar datos que estan en el registro
            $this->product_selected['quantity'] = $product->pivot->quantity;
            $this->product_selected['discount'] = $product->pivot->discount;
            $this->product_selected['price'] = $product->pivot->price;
            $this->product_selected['total_price'] = $product->pivot->total_price;
            $this->product_selected['cost'] = $product->pivot->cost;
            $this->product_selected['total_cost'] = $product->pivot->total_cost;
            $this->product_selected['product_id'] = $product->pivot->product_id;

            // agregar datos del producto
            $this->product_selected['dates'] = Product::find($this->product_selected['product_id']);
        
        // agregar array con id, cantidad, descuento unitario, datos, precios
        $this->products_selected[] = $this->product_selected;        

        $this->reset('product_selected');

        }

        foreach($this->products_selected as $index => $product){
            $this->temporalTotalPrice += $product['total_price'];
        }
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Order $order) {
        $this->resetProperties();

        $this->order = $order;
        
        $this->authorize('update', $this->order); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->order);

        $this->showActionModal = true;
    }

    public function viewActionModal(Order $order){
        $this->resetProperties();

        $this->order = $order;
        
        $this->authorize('update', $this->order); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->order);

        $this->showViewModal = true;
    }

    // boton de guardar o editar
    public function save() {
        // dd($this->client_id);
        // poner datos automaticos
        $this->is_maked = $this->is_maked ? '1' : '0';
        $this->is_paid = $this->is_paid ? '1' : '0';
        $this->is_delivered = $this->is_delivered ? '1' : '0';
        $this->status = $this->status ? '1' : '0';

        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;
        
        // nombre de la orden
        $this->name = $this->company_id.'_'.$this->user_id.'_'.now()->format('Y-m-d').'_'.Str::random(5);

        // validar datos
        $this->validate();

        // editar o crear
        if( isset( $this->order['id'])) {

            // editar datos de la orden
            $this->order->update(
                $this->only(['name', 'date', 'client', 'adress', 'shipping_methods_id', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'client_id', 'user_id', 'company_id'])
            );
            // si existen productos asociados
            if($this->products_selected){
                foreach ($this->products_selected as $product) {
                    if($product['product_id']){
                        $dataToSync[$product['product_id']] = [
                                'quantity' => $product['quantity'], 
                                'discount' => $product['discount'],
                                'price' => $product['price'],
                                'total_price' => $product['total_price'],
                                'cost' => $product['cost'],
                                'total_cost' => $product['total_cost'],
                            ];
                    }   
    
                    // sumar con cada iteracion el precio y cantidad
                    $this->total_products += $product['quantity'];
                    $this->total_price += $product['total_price'];
                    $this->total_cost += $product['total_cost'];
                };
    
                // sincronizar los productos borrados y agregados en la edicion
                $this->order->products()->sync($dataToSync);
    
                // actualizar las nuevas cantidades y precio total
                $this->order->update(
                    $this->only(['total_cost','total_price', 'total_products'])
                );

            }else{
                // si al editar no quedan productos, reempazar por un array vacio, cantidad y precio en cero
                $this->products_selected = [];
                $this->order->products()->sync($this->products_selected);
                $this->total_products = 0;
                $this->total_price = 0;
                $this->total_cost = 0;
                $this->order->update(
                    $this->only(['total_cost','total_price', 'total_products'])
                );
            }

            $this->reset(['order']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {
            $this->status = '0';
            // crear datos
            $this->order = Order::create(
                $this->only(['name', 'date', 'client', 'adress', 'shipping_methods_id', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'client_id', 'user_id', 'company_id'])
            );

            // crear en cada ID los datos de cada producto
            if($this->products_selected){
            foreach ($this->products_selected as $product) {
                if($product['product_id']){
                    $dataToSync[$product['product_id']] = [
                            'quantity' => $product['quantity'], 
                            'discount' => $product['discount'],
                            'price' => $product['price'],
                            'total_price' => $product['total_price'],
                            'cost' => $product['cost'],
                            'total_cost' => $product['total_cost'],
                        ];
                }

                // tener las cantidades y suma total de los productos
                $this->total_products += $product['quantity'];
                $this->total_price += $product['total_price'];
                $this->total_cost += $product['total_cost'];
            };


            // guardar productos y actualizar cantidad y precio en la orden
            $this->order->products()->sync($dataToSync);
            $this->order->update(
                $this->only(['total_cost', 'total_price', 'total_products'])
            );
            
            }else{
                // si no hay productos, dejar array vacio, cantidad y precio en cero
                $this->products_selected = [];
                $this->order->products()->sync($this->products_selected);
                $this->total_products = 0;
                $this->total_price = 0;
                $this->order->update(
                    $this->only(['total_cost', 'total_price', 'total_products'])
                );
            }

            $this->reset(['order']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }
    
    public function render()
    {

        $orders = Order::select('id', 'name', 'date', 'client', 'adress', 'shipping_methods_id', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'client_id', 'user_id', 'company_id', 'total_price', 'total_products')
        ->with('products', 'shipping_method', 'user', 'company')
        ->where('company_id', auth()->user()->company_id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('name', 'like', '%'.$this->search . '%')
                        ->orWhere('client', 'like', '%'.$this->search . '%');
            });
        })
        ->when($this->active, function( $query) {
            return $query->where('status', 0);
        })
        ->when($this->is_maked, function( $query) {
            return $query->where('is_maked', 0);
        })
        ->when($this->is_paid, function( $query) {
            return $query->where('is_paid', 0);
        })
        ->when($this->is_delivered, function( $query) {
            return $query->where('is_delivered', 0);
        })
        ->when($this->date_start, function( $query) {
            return $query->where('orders.date', '>=', $this->date_start);
        })
        ->when($this->date_finish, function( $query) {
            return $query->where('orders.date', '<=', $this->date_finish);
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_order');

        $order = $this->order;

        $clients = Client::class::get();
        $shipped_methods = ShippingMethod::get();
        $available_products = Product::with('category')->where('status', '1')->where('company_id', auth()->user()->company_id)->get();
        $categories = Category::where('company_id', auth()->user()->company_id)->where('status', '1')->get();


        return view('livewire.page.order-index', compact(
            'orders', 
            'order',
            'shipped_methods',
            'available_products',
            'categories',
            'clients',
        ));
    }
}
