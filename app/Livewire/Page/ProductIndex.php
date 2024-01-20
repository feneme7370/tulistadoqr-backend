<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Category;
use App\Models\Page\Tag;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductIndex extends Component
{
    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage();}
    public function updatingSearch() {$this->resetPage();}

    // subir archivos
    use WithFileUploads;

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

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
    public $category_id;
    public $level_id;
    public $user_id;
    public $company_id;

    // cargar imagen para guardar y almacenar string en image_hero
    public $image_hero_nueva;

    // propiedades para editar
    public $product;

    // propiedades para editar
    public $product_tags = [];

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'price_original' => ['required', 'numeric', 'min:1'],
            'price_seller' => ['nullable', 'numeric', 'min:1'],
            'quantity' => ['nullable', 'numeric', 'min:1'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['numeric'],
            'image_hero' => ['nullable', 'string'],
            'category_id' => ['required', 'numeric'],
            'level_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],

            'image_hero_nueva' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
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
        'image_hero' => 'imagen de portada',
        'category_id' => 'categoria',
        'level_id' => 'nivel',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'image_hero_nueva' => 'archivo de imagen',
    ];

    // eliminar imagen al reemplazarla
    public function deleteImage(){
        if($this->image_hero != ''){
            $path = public_path('archives/images/product_hero/'.$this->image_hero);
            if(file_exists($path)){
                unlink($path);
            }
        }
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

        // Verificar si la carpeta existe, si no, crearla
        $path = public_path('archives/images/product_hero/');
        // if (!file_exists($path)) {
        //     mkdir($path, 0777, true);
        // }

        // crear o reemplazar imagen
        if($this->image_hero_nueva){
            $this->deleteImage();
            $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id.'.jpg';
            $image_hero = Image::make($this->image_hero_nueva);
            $image_hero->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_hero->save(public_path('archives/images/product_hero/'.$name));
            $this->image_hero = $name;
        }
    }

    // contar elementos de membresia
    public function countProducts() {
        $amount = count(Product::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->product;
        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida');
            return true;
        }
    }

    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->resetErrorBag();
        $this->showDeleteModal = true;
        $this->product = Product::findOrFail($id);
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteProduct() {
        $product = Product::findOrFail($this->product->id);

        $this->image_hero = $product['image_hero'];
        $this->deleteImage();

        $product->delete();

        session()->flash('messageSuccess', 'Registro eliminado');
        $this->reset();
        $this->showDeleteModal = false;
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countProducts()){return;}
        $this->resetErrorBag();
        $this->reset(['product']);
        $this->reset(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'image_hero_nueva', 'category_id', 'level_id', 'user_id', 'company_id']);
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Product $product) {
        $this->resetErrorBag();
        $this->reset(['product']);
        $this->reset(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'image_hero_nueva', 'category_id', 'level_id', 'user_id', 'company_id']);

        $this->product = $product;
        $this->name = $product['name'];
        $this->slug = $product['slug'];
        $this->price_original = $product['price_original'];
        $this->price_seller = $product['price_seller'];
        $this->quantity = $product['quantity'];
        $this->description = $product['description'];
        $this->status = $product['status'] == '1' ? true : false;
        $this->image_hero = $product['image_hero'];
        $this->category_id = $product['category_id'];
        $this->level_id = $product['level_id'];
        $this->user_id = $product['user_id'];
        $this->company_id = $product['company_id'];
        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // crear datos necesarios
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar form
        $this->validate();

        // subir imagen de portada
        $this->uploadImage();
        
        // crear o editar segun id
        if( isset( $this->product['id'])) {

            $this->product->update(
                $this->only(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'category_id', 'level_id', 'user_id', 'company_id'])
            );

            $this->product->tags()->sync($this->product_tags);

            $this->reset(['product']);
            $this->reset(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'image_hero_nueva', 'category_id', 'level_id', 'user_id', 'company_id']);

            session()->flash('messageSuccess', 'Actualizado');

        } else {

            $product = Product::create(
                $this->only(['name', 'slug', 'price_original', 'price_seller', 'quantity', 'description', 'status', 'image_hero', 'category_id', 'level_id', 'user_id', 'company_id'])
            );

            $product->tags()->sync($this->product_tags);

            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }
    
    public function render()
    {
        $categories = Category::where('company_id', auth()->user()->company_id)->get();
        $tags = Tag::where('company_id', auth()->user()->company_id)->get();
        $levels = Level::where('company_id', auth()->user()->company_id)->get();

        $products = Product::where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate(10);
        return view('livewire.page.product-index', compact('categories', 'levels', 'products', 'tags'));
    }
}
