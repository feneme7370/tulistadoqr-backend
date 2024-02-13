<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Tag;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Category;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\helpers\sistem\CrudInterventionImage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductIndex extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_product');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_product');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_product');}
    public function updatingCategorySearch() {$this->resetPage(pageName: 'p_product');}

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;
    public $categorySearch;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ],];
    }

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showDeleteModal = false;

    // propiedades del form
    public $name;
    public $slug;
    public $price_original;
    public $price_seller;
    public $quantity;
    public $description;
    public $status;
    public $image_hero;
    public $image_hero_uri;
    public $image_hero_new;
    public $category_id;
    public $level_id;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $product;
    public $dataImage;

    // propiedades para editar
    public $product_tags = [];

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'price_original' => ['required', 'numeric', 'min:1'],
            'price_seller' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['numeric'],
            'image_hero_uri' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'category_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],

            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'price_original' => 'precio original',
        'price_seller' => 'precio de oferta',
        'quantity' => 'cantidad',
        'description' => 'descripcion',
        'status' => 'estado',
        'image_hero_uri' => 'uri imagen de portada',
        'image_hero' => 'imagen de portada',
        'category_id' => 'categoria',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'image_hero_new' => 'archivo de imagen',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // contar elementos de membresia
    public function countProducts() {
        $amount = count(Product::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->product;
        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida');
            return true;
        }
    }
    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'category_id', 'user_id', 'company_id']);
    }

    ///////////////////////////// MODULO IMAGENES /////////////////////////////

    // eliminar imagen al reemplazarla
    public function deleteImage(){
        CrudInterventionImage::deleteImage(
            $this->image_hero, 
            auth()->user()->company->id . '/products/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageEdit() {
        $this->deleteImage();
        $this->image_hero = '';
        $this->product->update(
            $this->only(['image_hero'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImage(){

        // crear o reemplazar imagen
        if($this->image_hero_new){
            $this->dataImage = CrudInterventionImage::uploadImage(
                $this->image_hero, 
                auth()->user()->company->id . '/products/', 
                $this->image_hero_new
            );

            $this->image_hero = $this->dataImage[0];
        }
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // abrir modal y recibir id
    // public function openDeleteModal($id){
    //     $this->resetProperties();

    //     $this->product = Product::findOrFail($id);
    //     $this->authorize('delete', $this->product); 
        
    //     $this->showDeleteModal = true;
    // }
    
    // eliminar desde el modal de confirmacion
    // public function deleteProduct() {
    //     $this->resetProperties();

    //     $product = Product::findOrFail($this->product->id);

    //     $this->image_hero = $product['image_hero'];
        
    //     $this->deleteImage();
    //     $product->delete();

    //     session()->flash('messageSuccess', 'Registro eliminado');
    //     $this->resetProperties();
    //     $this->reset('product');

    //     $this->showDeleteModal = false;
    // }

    // eliminar desde sweetalert
    protected $listeners = ['deleteProductId'];
    public function deleteProductId($id){
        $this->resetProperties();

        $this->product = Product::findOrFail($id);
        $this->authorize('delete', $this->product); 

        $this->image_hero = $this->product['image_hero'];
        
        $this->deleteImage();
        $this->product->delete();

        $this->resetProperties();
        $this->reset('product');
        // session()->flash('messageSuccess', 'Registro eliminado');
        $this->dispatch('toastifyProduct', 'Eliminado con exito');

    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countProducts()){return;}
        
        $this->resetProperties();
        $this->reset(['product']);
        
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Product $product) {
        $this->resetProperties();
        
        $this->product = $product;
        $this->authorize('update', $this->product); 
        
        $this->name = $product['name'];
        $this->slug = $product['slug'];
        $this->price_original = $product['price_original'];
        $this->price_seller = $product['price_seller'];
        $this->quantity = $product['quantity'];
        $this->description = $product['description'];
        $this->status = $product['status'] == '1' ? true : false;
        $this->image_hero_uri = $product['image_hero_uri'];
        $this->image_hero = $product['image_hero'];
        $this->category_id = $product['category_id'];
        $this->user_id = $product['user_id'];
        $this->company_id = $product['company_id'];

        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->price_seller = $this->price_seller == '' ? '0' : $this->price_seller ;
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar form
        $this->validate();

        // subir imagen de portada
        $this->uploadImage();
        if($this->dataImage){
            $this->image_hero_uri = $this->dataImage[1];
        }
        
        // crear o editar segun id
        if( isset( $this->product['id'])) {

            // editar datos
            $this->product->update(
                $this->only(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'image_hero_uri', 'category_id', 'user_id', 'company_id'])
            );

            $this->product->tags()->sync($this->product_tags);

            $this->reset(['product']);
            $this->resetProperties();

            // session()->flash('messageSuccess', 'Actualizado con exito');
            $this->dispatch('toastifyProduct', 'Actualizado con exito');

        } else {

            // crear datos
            $product = Product::create(
                $this->only(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'image_hero_uri', 'category_id', 'user_id', 'company_id'])
            );

            $product->tags()->sync($this->product_tags);

            $this->reset(['product']);
            $this->resetProperties();

            // session()->flash('messageSuccess', 'Guardado con exito');
            $this->dispatch('toastifyProduct', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }
    
    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $categories = Category::where('company_id', auth()->user()->company_id)
                        ->orderBy('level_id', 'DESC')->get();

        $tags = Tag::where('company_id', auth()->user()->company_id)->get();

        $levels = Level::where('company_id', auth()->user()->company_id)->get();

        $products = Product::where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%')
                                ->orWhereHas('category', function ($q) {
                                    $q->where('name', 'like', '%'.$this->search . '%');
                                });
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->when($this->categorySearch, function( $query) {
                            return $query->where('category_id', $this->categorySearch);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_product');

        return view('livewire.page.product-index', compact(
            'categories', 
            'products', 
            'tags'));
    }
}
