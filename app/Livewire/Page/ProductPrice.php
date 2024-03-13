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
            'price_original' => ['nullable', 'numeric', 'min:0'],
            'price_seller' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'price_original' => 'precio original',
        'price_seller' => 'precio de oferta',
    ];

    ///////////////////////////// MODULO CRUD /////////////////////////////

    // boton de guardar o editar
    public function save() {

        // validar form
        $this->validate();

        // editar datos
        foreach($this->productsChecked as $productChecked){
            $this->product = Product::findOrFail($productChecked);

            $this->authorize('update', $this->product); 
            
            if($this->price_original != null){
                $this->product->update($this->only(['price_original']));
            }
            if($this->price_seller != null){
                $this->product->update($this->only(['price_seller']));
            }

        }
        $this->resetProperties();

        $this->dispatch('toastrSuccess', 'Actualizado con exito');

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
