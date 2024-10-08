<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\helpers\sistem\CrudInterventionImage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class LevelIndex extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_level');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_level');}

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
    public $name;
    public $slug;
    public $description;
    public $status;
    public $image_hero;
    public $image_hero_uri;
    public $image_hero_new;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $level;
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
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'image_hero_new' => 'archivo de imagen',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // contar elementos de niveles
    public function countLevels() {
        $amount = count(Level::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->level;
        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida de '.$membershipNumber.' categorias');
            $this->dispatch('toastrError', 'Excede la cantidad permitida de '.$membershipNumber.' categorias');
            return true;
        }
    }

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'user_id', 'company_id', 'dataImage']);
    }

    ///////////////////////////// MODULO IMAGENES /////////////////////////////

    // eliminar imagen al reemplazarla
    public function deleteImage(){
        CrudInterventionImage::deleteImage(
            $this->image_hero, 
            auth()->user()->company->id . '/levels/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageEdit() {
        $this->deleteImage();

        $this->image_hero = '';
        $this->level->update(
            $this->only(['image_hero'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImage(){

        // crear o reemplazar imagen
        if($this->image_hero_new){
            $this->dataImage = CrudInterventionImage::uploadImage(
                $this->image_hero, 
                auth()->user()->company->id . '/levels/', 
                $this->image_hero_new
            );

            $this->image_hero = $this->dataImage['filename'];
        }
    }

    // rotar imagen
    public function rotateImage(){

        $imageRotated = CrudInterventionImage::rotateImage(
            $this->image_hero, 
            auth()->user()->company->id . '/levels/'
        );

        if($imageRotated != false){
            $this->image_hero = $imageRotated['filename'];
            $this->level->update(
                $this->only(['image_hero'])
            );
        }else{
            return $this->dispatch('toastrError', 'Error, cargar nuevamente la imagen');
        }
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteLevelId'];
    public function deleteLevelId($id){
        $this->resetProperties();

        $this->level = Level::findOrFail($id);
        $this->authorize('delete', $this->level); 

        // comprobar si tiene productos asignados
        if($this->level->categories->count() > 0){
            session()->flash('messageError', 'No se puede eliminar, tiene categorias asignados');
            $this->resetProperties();
        }else{
            $this->image_hero = $this->level['image_hero'];
            
            $this->deleteImage();
            $this->level->delete();

            $this->resetProperties();
            $this->reset('level');


            // session()->flash('messageSuccess', 'Registro eliminado');
            $this->dispatch('toastrSuccess', 'Eliminado con exito');
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countLevels()){return;}
        
        $this->resetProperties();
        $this->reset(['level']);

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
        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Level $level) {
        $this->resetProperties();

        $this->level = $level;
        $this->authorize('update', $this->level); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->level);

        $this->showActionModal = true;
    }

    public function viewActionModal(Level $level){
        $this->resetProperties();
        $this->resetErrorBag();

        $this->level = $level;
        
        $this->authorize('update', $this->level);         

        $this->preloadEditModal($this->level);
        
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

        if( isset( $this->level['id'])) {

            // editar datos
            $this->level->update(
                $this->only(['name', 'slug', 'description', 'image_hero', 'image_hero_uri', 'status', 'user_id', 'company_id'])
            );

            $this->reset(['level']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            Level::create(
                $this->only(['name', 'slug', 'description', 'image_hero', 'image_hero_uri', 'status', 'user_id', 'company_id'])
            );

            $this->reset(['level']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render(){

        $levels = Level::select('id', 'name', 'image_hero_uri', 'image_hero', 'status', 'description', 'user_id')
                        ->with('user', 'company')
                        ->where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_level');

        $level = $this->level;

        return view('livewire.page.level-index', compact(
            'levels', 
            'level'
        ));
    }
}
