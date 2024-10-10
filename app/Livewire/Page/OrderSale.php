<?php

namespace App\Livewire\Page;

use App\Models\Page\Client;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Page\Order;
use App\Models\Page\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;



class OrderSale extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_order_sale');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_order_sale');}

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10, $date_start, $date_finish, $years_sales;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ], 'date_start' => [ 'as' => 'ds' ], 'date_finish' => [ 'as' => 'df' ]];
    }

    public function mount(){
        $this->date_start = Carbon::today()->addDays(-7)->toDateString();
        $this->date_finish = Carbon::today()->addDays(7)->toDateString();
        $this->years_sales = Carbon::now()->year;
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

    public $amount_total_price = 0;
    public $amount_total_cost = 0;

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
        $this->reset(['quantity', 'discount', 'is_maked', 'is_paid', 'is_delivered', 'total_cost','total_price', 'price', 'cost', 'amount_total_price', 'amount_total_cost']);
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

    // resetar al cambiar de fecha
    public function updatedDateStart(){
        $this->resetProperties();
    }
    public function updatedDateFinish(){
        $this->resetProperties();
    }
    
    public function render()
    {
        $products = Product::join('order_products', 'products.id', '=', 'order_products.product_id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('orders', 'order_products.order_id', 'orders.id')
            ->select('products.id', 'products.name', 'orders.name as order_name', 'orders.status as order_status', 'orders.date as order_date', 'orders.is_paid as order_is_paid', 'categories.name as category_name', DB::raw('SUM(order_products.total_price) as amount_price'), DB::raw('SUM(order_products.total_cost) as amount_cost'))

            ->where('products.company_id', auth()->user()->company_id)
            ->where('orders.is_paid', '1')
            ->where('orders.status', '1')
            ->with('category', 'user', 'company') 

            ->groupBy('products.id', 'products.name', 'categories.name', 'orders.status', 'orders.date', 'order_is_paid', 'orders.name') // Agrupa por ID y nombre del producto
            ->orderBy('order_date', 'desc') // Opcional: ordenar por nombre
            ->when( $this->search, function($query) {
                return $query->where(function( $query) {
                    $query->where('products.name', 'like', '%'.$this->search . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'like', '%'.$this->search . '%');
                    });
                });
            })
            ->when($this->date_start, function( $query) {
                return $query->where('orders.date', '>=', $this->date_start);
            })
            ->when($this->date_finish, function( $query) {
                return $query->where('orders.date', '<=', $this->date_finish);
            })
        ->paginate($this->perPage, pageName: 'p_order_sale');


        $sale_for_orders = Order::select('id', 'name', 'client', 'date', 'total_price', 'total_cost', 'client_id', 'status')
                    ->where('company_id', auth()->user()->company_id)
            ->where('is_paid', '1')
            ->where('status', '1')
            ->with('user', 'company', 'customer') 
            ->orderBy('date', 'desc') // Opcional: ordenar por nombre
            ->when( $this->search, function($query) {
                return $query->where(function( $query) {
                    $query->where('name', 'like', '%'.$this->search . '%')
                    ->orWhereHas('customer', function ($q) {
                        $q->where('name', 'like', '%'.$this->search . '%');
                    });
                });
            })
            ->when($this->date_start, function( $query) {
                return $query->where('date', '>=', $this->date_start);
            })
            ->when($this->date_finish, function( $query) {
                return $query->where('date', '<=', $this->date_finish);
            })
        ->paginate($this->perPage, pageName: 'p_order_sale');
        
        foreach($products as $product){
            $this->amount_total_price += $product->amount_price;
            $this->amount_total_cost += $product->amount_cost;
        }

        // Trae todas las ventas del año actual
        $orders_by_year = Order::whereYear('date', $this->years_sales)
            ->where('company_id', auth()->user()->company_id)
            ->where('is_paid', '1')
            ->where('status', '1')
            ->get();

        // Filtra por mes
        $orders_by_month = $orders_by_year->groupBy(function($order) {
            return Carbon::parse($order->date)->format('m'); // Agrupa por mes (01, 02, etc.)
        });

        // Luego puedes calcular las ventas de cada mes
        $sales_by_orders = $orders_by_month->map(function($month_orders) {
            return [
                'sum_sales' => $month_orders->sum('total_price'), // Calcula la suma de ventas del mes
                'sum_costs' => $month_orders->sum('total_cost'), // Calcula la suma de ventas del mes
                'count_orders' => $month_orders->count(),           // Número total de órdenes del mes
            ];
        });



        // Trae todas las órdenes y agrupa por año único
        $years_to_orders = Order::select('date')
            ->get()
            ->groupBy(function($order) {
                return Carbon::parse($order->date)->format('Y'); // Agrupa por año completo (2024, etc.)
            });

        // Extrae solo los años únicos
        $sales_years = $years_to_orders->keys(); // Obtiene los años únicos como una colección

        // dd($this->years_sales);
        return view('livewire.page.order-sale', compact(
            'products',
            'sale_for_orders',
            'sales_by_orders',
            'sales_years',
        ));
    }
}
