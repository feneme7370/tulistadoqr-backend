<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Tag;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Category;
use App\helpers\sistem\CrudInterventionImage;
use App\Models\Page\Picture;
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
    public function updatingOffers() {$this->resetPage(pageName: 'p_product');}
    public function updatingCategorySearch() {$this->resetPage(pageName: 'p_product');}

    // propiedades de busqueda
    public $active = true, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;
    
    public $categorySearch;
    public $offers = false;

    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'categorySearch' => [ 'as' => 'c' ],
        ];
    }

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showViewModal = false;

    // propiedades del form
    public $name;
    public $slug;
    public $price_original;
    public $price_seller;
    public $cost;
    public $quantity;
    public $description;
    public $description2;
    public $description3;
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

    // propiedad de existentes y nuevas imagenes asociadas
    public $product_pictures = [];
    public $product_new_pictures = [];

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'price_original' => ['required', 'numeric', 'min:1'],
            'price_seller' => ['nullable', 'numeric', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'quantity' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string', 'max:255'],
            'description2' => ['nullable', 'string', 'max:255'],
            'description3' => ['nullable', 'string', 'max:255'],
            'status' => ['numeric'],
            'image_hero_uri' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'category_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],

            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'product_new_pictures.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'price_original' => 'precio original',
        'price_seller' => 'precio de oferta',
        'cost' => 'costo',
        'quantity' => 'cantidad',
        'description' => 'descripcion',
        'description2' => 'descripcion2',
        'description3' => 'descripcion3',
        'status' => 'estado',
        'image_hero_uri' => 'uri imagen de portada',
        'image_hero' => 'imagen de portada',
        'category_id' => 'categoria',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'image_hero_new' => 'archivo de imagen',
        'product_new_pictures' => 'archivo de imagen',
        'product_new_pictures.*' => 'archivo de imagen',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // contar elementos de membresia
    public function countProducts() {
        $amount = count(Product::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->product;

        if($amount >= $membershipNumber){
            $this->dispatch('toastrError', 'Excede la cantidad permitida de '.$membershipNumber.' productos');
            return true;
        }
    }

    // contar pictures de membresia
    public function countPictures() {
        if($this->product_new_pictures){

            // existentes + nuevos = total
            $amountExist = count($this->product->pictures);
            $amount = count($this->product_new_pictures);
            $membershipNumber = auth()->user()->company->membership->product_pictures;

            $amountTotal = $amount + $amountExist;

            if($amountTotal > $membershipNumber){
                session()->flash('messageError', 'Excede la cantidad permitida de '.$membershipNumber.' imagenes');
                $this->dispatch('toastrError', 'Excede la cantidad permitida de '.$membershipNumber.' imagenes');
                return true;
            }
        }
    }

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'price_original', 'price_seller', 'cost', 'quantity', 'description', 'description2', 'description3', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'category_id', 'user_id', 'company_id', 'product_tags', 'product_pictures', 'product_new_pictures', 'dataImage']);
    }

    // ordenar la tabla
    public function orderTable($column){
        if($this->sortBy != $column){
            $this->sortBy = $column;
        }else{
            $this->sortAsc = !$this->sortAsc;
        }
    }

    ///////////////////////////// MODULO IMAGENES /////////////////////////////

    // eliminar imagen de portada al reemplazarla
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

            $this->image_hero = $this->dataImage['filename'];
        }
    }

    // subir imagenes del producto
    public function uploadProductPictures(){

        // si hay nuevas imagenes, realizar accion
        if($this->product_new_pictures){

            if(!$this->countPictures()){
                foreach($this->product_new_pictures as $item){
                    $data = CrudInterventionImage::uploadProductPictures(
                        auth()->user()->company->id . '/product_pictures/', 
                        $item,
                        'App\Models\Page\Picture',
                    );
                    
                    // agregar registro en BD
                    $this->product->pictures()->attach($data['dataImage']['id']);
                }
            }
            
        }
    }

    // rotar imagen de portada
    public function rotateImage(){
        $imageRotated = CrudInterventionImage::rotateImage(
            $this->image_hero, 
            auth()->user()->company->id . '/products/'
        );

        if($imageRotated != false){
            $this->image_hero = $imageRotated['filename'];
            $this->product->update(
                $this->only(['image_hero'])
            );
        }else{
            return $this->dispatch('toastrError', 'Error, cargar nuevamente la imagen');;
        }
    }

    // rotar imagenes asociadas
    public function rotateProductPicture(Picture $picture){
        // pasar nombre y ruta
        $imageRotated = CrudInterventionImage::rotateImage(
            $picture->name, 
            auth()->user()->company->id . '/product_pictures/'
        );

        // si se edita realizar accion
        if($imageRotated != false){
            
            $imageToRotate = Picture::find($picture->id);
            $imageToRotate->update([
                'name' => $imageRotated['filename'],
                'route' => $imageRotated['uri'],
            ]);
        }else{
            return $this->dispatch('toastrError', 'Error, cargar nuevamente la imagen');;
        }
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteProductId'];

    // eliminar producto con imagenes asociadas
    public function deleteProductId($id){
        $this->resetProperties();

        $this->product = Product::findOrFail($id);
        $this->authorize('delete', $this->product); 

        // eliminar portada
        $this->image_hero = $this->product['image_hero'];
        $this->deleteImage();
        
        // eliminar imagenes asociadas
        foreach($this->product->pictures as $item){
            $this->deleteProductPicture($item);
        }

        $this->product->delete();

        $this->resetProperties();
        $this->reset('product');
        $this->dispatch('toastrSuccess', 'Eliminado con exito');

    }

    // eliminar fotos del producto asociado
    public function deleteProductPicture(Picture $picture){
        CrudInterventionImage::deleteImage(
            $picture->name, 
            auth()->user()->company->id . '/product_pictures/',
        );

        $this->product->pictures()->detach($picture->id);
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countProducts()){return;}
        
        $this->resetProperties();
        $this->reset(['product']);
        
        $this->status = true;
        $this->showActionModal = true;
    }

    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->slug = $item['slug'];
        $this->price_original = $item['price_original'];
        $this->price_seller = $item['price_seller'];
        $this->cost = $item['cost'];
        $this->quantity = $item['quantity'];
        $this->description = $item['description'];
        $this->description2 = $item['description2'];
        $this->description3 = $item['description3'];
        $this->status = $item['status'] == '1' ? true : false;
        $this->image_hero_uri = $item['image_hero_uri'];
        $this->image_hero = $item['image_hero'];
        $this->category_id = $item['category_id'];
        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];

        $this->product_tags = $this->product->tags->pluck('id')->toArray();
        $this->product_pictures = $this->product->pictures->pluck('id')->toArray();

    }

    // mostrar modal para confirmar editar
    public function editActionModal(Product $product) {
        $this->resetProperties();
        
        $this->product = $product;
        $this->authorize('update', $this->product); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->product);

        $this->showActionModal = true;
    }

    public function viewActionModal(Product $product){
        $this->resetProperties();
        $this->resetErrorBag();

        $this->product = $product;
        
        $this->authorize('update', $this->product);         

        $this->preloadEditModal($this->product);
        
        $this->showViewModal = true;
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
            $this->image_hero_uri = $this->dataImage['uri'];
        }

        // subir imagenes del producto
        $this->uploadProductPictures();
        
        // crear o editar segun id
        if( isset( $this->product['id'])) {
            
            // editar datos
            $this->product->update(
                $this->only(['name', 'slug', 'price_original', 'price_seller', 'cost', 'quantity', 'description', 'description2', 'description3', 'status', 'image_hero', 'image_hero_uri', 'category_id', 'user_id', 'company_id'])
            );

            $this->product->tags()->sync($this->product_tags);

            $this->reset(['product']);
            $this->resetProperties();

            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            $product = Product::create(
                $this->only(['name', 'slug', 'price_original', 'price_seller', 'cost', 'quantity', 'description', 'description2', 'description3', 'status', 'image_hero', 'image_hero_uri', 'category_id', 'user_id', 'company_id'])
            );

            $product->tags()->sync($this->product_tags);

            $this->reset(['product']);
            $this->resetProperties();

            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }
    
    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $categories = Category::with('level')
                        ->where('company_id', auth()->user()->company_id)
                        ->orderBy('level_id', 'DESC')->get();

        $tags = Tag::where('company_id', auth()->user()->company_id)->get();

        $levels = Level::where('company_id', auth()->user()->company_id)->get();

        $products = Product::select('id', 'name', 'price_original', 'price_seller', 'image_hero_uri', 'image_hero', 'description', 'description2', 'description3', 'status', 'category_id')
                        ->with('category', 'category.level', 'tags')
                        ->where('company_id', auth()->user()->company_id)
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
                        ->when($this->offers, function( $query) {
                            return $query->where('price_seller', '!=' , '0');
                        })
                        ->when($this->categorySearch, function( $query) {
                            return $query->where('category_id', $this->categorySearch);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_product');

        $product = $this->product;

        return view('livewire.page.product-index', compact(
            'categories', 
            'products', 
            'tags',
            'product',
            'levels',
        ));
    }
}
