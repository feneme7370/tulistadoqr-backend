<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Page\Category;
use App\helpers\sistem\CrudInterventionImage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CategoryIndex extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_category');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_category');}
    public function updatingPerPage() {$this->resetPage(pageName: 'p_category');}
    public function updatingCategoryGeneralSearch() {$this->resetPage(pageName: 'p_category');}

    // propiedades de busqueda
    public $active = true, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

    public $categoryGeneralSearch;

    // mostrar variables en queryString
    protected function queryString(){
        return [
        'search' => [ 'as' => 'q' ],
        'categoryGeneralSearch' => [ 'as' => 'l' ],
        ];
    }

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showViewModal = false;

    // propiedades del form
    public $name;
    public $slug;
    public $description;
    public $status;
    public $image_hero;
    public $image_hero_uri;
    public $image_hero_new;
    public $level_id;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $category;
    public $dataImage;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['numeric'],
            'image_hero_uri' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'level_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],

            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'description' => 'descripcion',
        'status' => 'estado',
        'image_hero_uri' => 'uri imagen de portada',
        'image_hero' => 'imagen de portada',
        'level_id' => 'nivel',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'image_hero_new' => 'archivo de imagen',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // contar elementos de membresia
    public function countCategories() {

        $amount = count(Category::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->category;

        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida de '.$membershipNumber.' categorias');
            $this->dispatch('toastrError', 'Excede la cantidad permitida de '.$membershipNumber.' categorias');
            return true;
        }
    }

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'level_id', 'user_id', 'company_id', 'dataImage']);
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

    // eliminar imagen al reemplazarla
    public function deleteImage(){
        CrudInterventionImage::deleteImage(
            $this->image_hero, 
            auth()->user()->company->id . '/categories/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageEdit() {

        $this->deleteImage();

        $this->image_hero = '';
        $this->category->update(
            $this->only(['image_hero'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImage(){

        // crear o reemplazar imagen
        if($this->image_hero_new){
            $this->dataImage = CrudInterventionImage::uploadImage(
                $this->image_hero, 
                auth()->user()->company->id . '/categories/', 
                $this->image_hero_new
            );

            $this->image_hero = $this->dataImage['filename'];
        }
    }

    // rotar imagen
    public function rotateImage(){
        $imageRotated = CrudInterventionImage::rotateImage(
            $this->image_hero, 
            auth()->user()->company->id . '/categories/'
        );

        if($imageRotated != false){
            $this->image_hero = $imageRotated['filename'];
            $this->category->update(
                $this->only(['image_hero'])
            );
        }else{
            return $this->dispatch('toastrError', 'Error, cargar nuevamente la imagen');;
        }
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteCategoryId'];
    public function deleteCategoryId($id){
        $this->resetProperties();

        $this->category = Category::findOrFail($id);
        $this->authorize('delete', $this->category); 

        // comprobar si tiene productos asignados
        if($this->category->products->count() > 0){
            session()->flash('messageError', 'No se puede eliminar, tiene productos asignados');
            $this->resetProperties();
        }else{
            $this->image_hero = $this->category['image_hero'];
            
            $this->deleteImage();
            $this->category->delete();

            $this->resetProperties();
            $this->reset('category');
            
            $this->dispatch('toastrSuccess', 'Eliminado con exito');
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countCategories()){return;}
        
        $this->reset(['category']);
        $this->resetProperties();

        $this->status = true;
        $this->showActionModal = true;
    }

    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->slug = $item['slug'];
        $this->description = $item['description'];
        $this->status = $item['status'] == '1' ? true : false;
        $this->image_hero = $item['image_hero'];
        $this->image_hero_uri = $item['image_hero_uri'];
        $this->level_id = $item['level_id'];
        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];
    }
    // // mostrar modal para confirmar editar
    public function editActionModal(Category $category) {
        $this->resetProperties();

        $this->category = $category;
        $this->authorize('update', $this->category); 

        $this->resetErrorBag();

        $this->preloadEditModal($this->category);

        $this->showActionModal = true;
    }

    public function viewActionModal(Category $category){
        $this->resetProperties();
        $this->resetErrorBag();
        $this->category = $category;
        
        $this->authorize('update', $this->category);      

        $this->preloadEditModal($this->category);
        
        $this->showViewModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar datos
        $this->validate();

        // subir imagen de portada
        $this->uploadImage();
        if($this->dataImage){
            $this->image_hero_uri = $this->dataImage['uri'];
        }
        
        if( isset( $this->category['id'])) {

            // editar datos
            $this->category->update(
                $this->only(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'level_id', 'user_id', 'company_id'])
            );

            $this->reset(['category']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            Category::create(
                $this->only(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'level_id', 'user_id', 'company_id'])
            );

            $this->reset(['category']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $levels = Level::where('company_id', auth()->user()->company->id)->get();
        $categories = Category::select('id', 'name', 'image_hero_uri', 'image_hero', 'description', 'status', 'user_id', 'level_id')
                        ->with(['user', 'level'])
                        ->where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->when($this->categoryGeneralSearch, function( $query) {
                            return $query->where('level_id', $this->categoryGeneralSearch);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_category');

        $category = $this->category;
                        
        return view('livewire.page.category-index', compact('categories', 'levels', 'category'));
    }
}