<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Category;

class ProductPrice extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_product');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_product');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_product');}
    public function updatingOffers() {$this->resetPage(pageName: 'p_product');}
    public function updatingCategorySearch() {$this->resetPage(pageName: 'p_product');}

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;
    public $categorySearch, $offers = false;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ],];
    }
    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['price_original', 'price_seller', 'productsChecked']);
    }
    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades del form
    public $name;
    public $price_original;
    public $price_seller;
    public $image_hero;
    public $image_hero_uri;
    public $category_id;
    public $status;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $product;
    public $productsChecked = [];

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'price_original' => ['nullable', 'numeric', 'min:1'],
            'price_seller' => ['nullable', 'numeric', 'min:1'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'price_original' => 'precio original',
        'price_seller' => 'precio de oferta',
    ];

    ///////////////////////////// MODULO CRUD /////////////////////////////
    // mostrar modal para confirmar editar
    // public function editActionModal(Product $product) {
    //     $this->resetProperties();
        
    //     $this->product = $product;
    //     $this->authorize('update', $this->product); 
        
    //     $this->name = $product['name'];
    //     $this->price_original = $product['price_original'];
    //     $this->price_seller = $product['price_seller'];
    //     $this->image_hero_uri = $product['image_hero_uri'];
    //     $this->image_hero = $product['image_hero'];
    //     $this->category_id = $product['category_id'];
    //     $this->user_id = $product['user_id'];
    //     $this->company_id = $product['company_id'];
    // }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        // $this->price_seller = $this->price_seller == '' ? '0' : $this->price_seller ;

        // validar form
        $this->validate();

        // dd($this->productsChecked);
        // editar datos
        foreach($this->productsChecked as $productChecked){
            $product = Product::findOrFail($productChecked);
            
            if($this->price_original){
                $product->update($this->only(['price_original']));
            }
            if($this->price_seller){
                $product->update($this->only(['price_seller']));
            }

        }
        $this->resetProperties();

        // session()->flash('messageSuccess', 'Actualizado con exito');
        $this->dispatch('toastifyProduct', 'Actualizado con exito');

    }
    public function render()
    {
        $categories = Category::with('level')
        ->where('company_id', auth()->user()->company_id)
        ->orderBy('level_id', 'DESC')->get();
        
        $products = Product::select('id', 'name', 'price_original', 'price_seller', 'image_hero_uri', 'image_hero', 'status', 'category_id')
        ->with('category', 'category.level', 'tags')
        ->where('company_id', auth()->user()->company_id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('name', 'like', '%'.$this->search . '%');
            });
        })
        ->when($this->active, function( $query) {
            return $query->where('status', 1);
        })
        ->when($this->offers, function( $query) {
            return $query->where('price_seller', '!=' , '0');
        })
        ->when($this->categorySearch, function( $query) {
            return $query->where('category_id', $this->categorySearch);
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_product');

        return view('livewire.page.product-price', compact(
            'categories',
            'products',
        ));
    }
}
