<?php

namespace App\Livewire\Page;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Page\Order;
use App\Models\Page\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Page\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_order_detail');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_order_detail');}

    // propiedades de busqueda
    public $active = true, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10, $date_start, $date_finish, $is_date;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ], 'date_start' => [ 'as' => 'ds' ], 'date_finish' => [ 'as' => 'df' ]];
    }

    public function mount(){
        $this->date_start = Carbon::today()->addDays(-7)->toDateString();
        $this->date_finish = Carbon::today()->addDays(7)->toDateString();
    }

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades del form
    public $quantity;
    public $discount;
    public $price;
    public $total_price;
    public $cost;
    public $total_cost;

    // props de order
    public $is_maked;
    public $is_paid;
    public $is_delivered;

    // propiedades para editar
    public $order;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'is_maked' => ['nullable', 'numeric'],
            'is_paid' => ['nullable', 'numeric'],
            'is_delivered' => ['nullable', 'numeric'],
            'status' => ['nullable', 'numeric'],
        ];
    }
    // renombrar variables a castellano
    protected $validationAttributes = [
        'is_maked' => 'hecho',
        'is_paid' => 'pagado',
        'is_delivered' => 'enviado',
        'status' => 'estado',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['quantity', 'discount', 'is_maked', 'is_paid', 'is_delivered', 'status', 'total_cost','total_price', 'price', 'cost']);
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

    // cargar datos a editar de la orden
    public function preloadEditModal($item){
        $this->quantity = $item['quantity'];
        $this->discount = $item['discount'];
        
        $this->cost = $item['cost'];
        $this->total_cost = $item['total_cost'];
        $this->price = $item['price'];
        $this->total_price = $item['total_price'];

    }


    public function render()
    {
        $products = Product::join('order_products', 'products.id', '=', 'order_products.product_id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('orders', 'order_products.order_id', 'orders.id')
            ->select('products.id', 'products.name', 'orders.is_maked as order_is_maked', 'categories.name as category_name', DB::raw('SUM(order_products.quantity) as total_quantity'))

            ->where('products.company_id', auth()->user()->company_id)
            ->where('orders.is_maked', '0')
            ->with('category', 'user', 'company') 

            ->groupBy('products.id', 'products.name', 'categories.name', 'order_is_maked') // Agrupa por ID y nombre del producto
            ->orderBy('category_name') // Opcional: ordenar por nombre
            ->when( $this->search, function($query) {
                return $query->where(function( $query) {
                    $query->where('products.name', 'like', '%'.$this->search . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%'.$this->search . '%');
                    });
                });
            })
            ->when($this->date_start, function( $query) {
                return $query->where('orders.date', '>', $this->date_start);
            })
            ->when($this->date_finish, function( $query) {
                return $query->where('orders.date', '<', $this->date_finish);
            })
            ->paginate($this->perPage, pageName: 'p_order_detail');

        $products_with_date = Product::join('order_products', 'products.id', '=', 'order_products.product_id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('orders', 'order_products.order_id', 'orders.id')
            ->select('products.id', 'products.name', 'orders.date as order_date', 'orders.is_maked as order_is_maked', 'categories.name as category_name', DB::raw('SUM(order_products.quantity) as total_quantity'))

            ->where('products.company_id', auth()->user()->company_id)
            ->where('orders.is_maked', '0')
            ->with('category', 'user', 'company') 

            ->groupBy('products.id', 'products.name', 'categories.name', 'orders.date', 'order_is_maked') // Agrupa por ID y nombre del producto
            ->orderBy('orders.date') // Opcional: ordenar por nombre
            ->when( $this->search, function($query) {
                return $query->where(function( $query) {
                    $query->where('products.name', 'like', '%'.$this->search . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%'.$this->search . '%');
                    });
                });
            })
            ->when($this->date_start, function( $query) {
                return $query->where('orders.date', '>', $this->date_start);
            })
            ->when($this->date_finish, function( $query) {
                return $query->where('orders.date', '<', $this->date_finish);
            })
            ->paginate($this->perPage, pageName: 'p_order_detail');

        return view('livewire.page.order-detail', compact(
            'products',
            'products_with_date',
        ));


    }
}
