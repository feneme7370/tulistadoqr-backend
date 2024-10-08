<?php

namespace App\Livewire\Page;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Page\Stock;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Category;
use App\Models\Page\TypeStock;

class StockIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_stock');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_stock');}

    // propiedades de busqueda
    public $active = true, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ],];
    }

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showViewModal = false;

    // propiedades del form
    public $date;
    public $name;
    public $quantity;
    public $type_stock_id;
    public $product_id;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $stock;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'date' => ['required', 'date'],
            'name' => ['required', 'string'],
            'quantity' => ['required', 'numeric'],
            'type_stock_id' => ['required', 'numeric'],

            'product_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'date' => 'fecha',
        'name' => 'nombre',
        'quantity' => 'cantidad',
        'type_stock_id' => 'tipo de movimiento',
        'product_id' => 'producto',
        'user_id' => 'usuario',
        'company_id' => 'empresa',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteStockId'];
    public function deleteStockId($id){
        $this->resetProperties();

        $this->stock = Stock::findOrFail($id);
        $this->authorize('delete', $this->stock); 

   
        $this->stock->delete();

        $this->resetProperties();
        $this->reset('stock');

        $this->dispatch('toastrSuccess', 'Eliminado con exito');
        
    }
    
    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['date', 'name', 'quantity', 'type_stock_id', 'product_id', 'user_id', 'company_id']);
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {      
        $this->resetProperties();
        $this->reset(['stock']);
        $this->date = Carbon::today()->toDateString();

        $this->showActionModal = true;
    }
    
    // cargar datos a editar
    public function preloadEditModal($item){
        $this->date = $item['date'];
        $this->name = $item['name'];
        $this->quantity = $item['quantity'];
        $this->type_stock_id = $item['type_stock_id'];
        $this->product_id = $item['product_id'];
        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Stock $stock) {
        $this->resetProperties();

        $this->stock = $stock;

        $this->authorize('update', $this->stock); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->stock);

        $this->showActionModal = true;
    }

    public function viewActionModal(Stock $stock){
        $this->resetProperties();

        $this->stock = $stock;

        $this->authorize('update', $this->stock); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->stock);

        $this->showViewModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;
        $this->name = $this->company_id.'_'.$this->user_id.'_'.now()->format('Y-m-d').'_'.Str::random(5);
        
        // validar datos
        $this->validate();

        if( isset( $this->stock['id'])) {

            // editar datos
            $this->stock->update(
                $this->only(['date', 'name', 'quantity', 'type_stock_id', 'product_id', 'user_id', 'company_id'])
            );

            $this->reset(['stock']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            Stock::create(
                $this->only(['date', 'name', 'quantity', 'type_stock_id', 'product_id', 'user_id', 'company_id'])
            );

            $this->reset(['stock']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }
    
    public function render()
    {

        $stocks = Stock::select('id', 'date', 'name', 'quantity', 'type_stock_id', 'product_id', 'user_id', 'company_id')
                        ->with('user', 'company', 'product')
                        ->where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_stock');
        $available_products = Product::with('category')->where('status', '1')->where('company_id', auth()->user()->company_id)->get();
        $categories = Category::where('company_id', auth()->user()->company_id)->where('status', '1')->get();
        $type_stocks = TypeStock::get();

        $stock = $this->stock;
        return view('livewire.page.stock-index', compact(
            'type_stocks',
            'available_products',
            'categories',
            'stocks',
            'stock',
        ));
    }
}
