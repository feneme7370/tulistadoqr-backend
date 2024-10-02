<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Order;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use Livewire\WithPagination;
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
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ],];
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
    public $type_send;
    public $description;
    public $is_maked;
    public $is_paid;
    public $is_delivered;

    public $status;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $order;

    // valores estaticos que van en columna de order
    public $total_price = 0;
    public $total_products = 0;

    // producto que se agregara al listado
    public $product_selected = ['product_id' => null, 'quantity' => 1, 'discount' => 0];
    
    // listado de arrays con cada producto
    public $products_selected = [];

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'date' => ['required', 'date'],
            'client' => ['required', 'string', 'min:1', 'max:255'],
            'adress' => ['required', 'string', 'min:1', 'max:255'],
            'type_send' => ['required', 'numeric'],
            'description' => ['nullable', 'string', 'min:1', 'max:255'],
            
            'is_maked' => ['nullable', 'numeric'],
            'is_paid' => ['nullable', 'numeric'],
            'is_delivered' => ['nullable', 'numeric'],
            'status' => ['nullable', 'numeric'],
            
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
        'type_send' => 'forma de envio',
        'description' => 'descripcion',
        'is_maked' => 'hecho',
        'is_paid' => 'pagado',
        'is_delivered' => 'enviado',
        'status' => 'estado',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'product_selected' => 'producto seleccionado',
        'products_selected' => 'productos seleccionado',

    ];

    
    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['date', 'client', 'adress', 'type_send', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'user_id', 'company_id', 'product_selected', 'products_selected', 'total_price', 'total_products']);
    }

    // eliminar producto de la orden, en una posicion determinada
    public function removeProduct($index){
        unset($this->products_selected[$index]);
        $this->products_selected = array_values($this->products_selected);
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
    
            // agregar array con id, cantidad y descuento unitario
            $this->products_selected[] = $this->product_selected;
            $this->reset('product_selected');
        }
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
        $this->type_send = $item['type_send'];
        $this->description = $item['description'];
        $this->is_maked = $item['is_maked'] == '1' ? true : false;
        $this->is_paid = $item['is_paid'] == '1' ? true : false;
        $this->is_delivered = $item['is_delivered'] == '1' ? true : false;
        $this->status = $item['status'] == '1' ? true : false;
        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];

        // cargar datos de productos asociados a la orden
        foreach ($this->order->products as $product) {
    
            // pegar datos que estan en el registro
            $this->product_selected['quantity'] = $product->pivot->quantity;
            $this->product_selected['discount'] = $product->pivot->discount;
            $this->product_selected['price'] = $product->pivot->price;
            $this->product_selected['total_price'] = $product->pivot->total_price;
            $this->product_selected['product_id'] = $product->pivot->product_id;

            // agregar datos del producto
            $this->product_selected['dates'] = Product::find($this->product_selected['product_id']);
        
        // agregar array con id, cantidad, descuento unitario, datos, precios
        $this->products_selected[] = $this->product_selected;
        $this->reset('product_selected');

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
                $this->only(['name', 'date', 'client', 'adress', 'type_send', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'user_id', 'company_id'])
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
                            ];
                    }   
    
                    // sumar con cada iteracion el precio y cantidad
                    $this->total_products += $product['quantity'];
                    $this->total_price += $product['total_price'];
                };
    
                $this->order->products()->sync($dataToSync);
    
                $this->order->update(
                    $this->only(['total_price', 'total_products'])
                );

            }else{
                $this->products_selected = [];
                $this->order->products()->sync($this->products_selected);
                $this->total_products = 0;
                $this->total_price = 0;
                $this->order->update(
                    $this->only(['total_price', 'total_products'])
                );
            }

            $this->reset(['order']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {
            // dd($this->product_selected);
            // crear datos
            $this->order = Order::create(
                $this->only(['name', 'date', 'client', 'adress', 'type_send', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'user_id', 'company_id'])
            );

            if($this->products_selected){
            foreach ($this->products_selected as $product) {
                if($product['product_id']){
                    $dataToSync[$product['product_id']] = [
                            'quantity' => $product['quantity'], 
                            'discount' => $product['discount'],
                            'price' => $product['price'],
                            'total_price' => $product['total_price'],
                        ];
                }

                $this->total_products += $product['quantity'];
                $this->total_price += $product['total_price'];
            };

                $this->order->products()->sync($dataToSync);
    
                $this->order->update(
                    $this->only(['total_price', 'total_products'])
                );
            }else{
                $this->products_selected = [];
                $this->order->products()->sync($this->products_selected);
                $this->total_products = 0;
                $this->total_price = 0;
                $this->order->update(
                    $this->only(['total_price', 'total_products'])
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

        $orders = Order::select('id', 'name', 'date', 'client', 'adress', 'type_send', 'description', 'is_maked', 'is_paid', 'is_delivered', 'status', 'user_id', 'company_id', 'total_price', 'total_products')
        ->with('user', 'company')
        ->where('company_id', auth()->user()->company_id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('client', 'like', '%'.$this->search . '%');
            });
        })
        ->when($this->active, function( $query) {
            return $query->where('status', 1);
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_order');

        $order = $this->order;

        $shipped_methods = ShippingMethod::get();
        $available_products = Product::where('company_id', auth()->user()->company_id)->get();


        return view('livewire.page.order-index', compact(
            'orders', 
            'order',
            'shipped_methods',
            'available_products',
        ));
    }
}
