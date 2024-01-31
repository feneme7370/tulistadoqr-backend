<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class LevelIndex extends Component
{
        use WithFileUploads;
        // paginacion
        use WithPagination;
        public function updatingActive() {$this->resetPage(pageName: 'p_level');}
        public function updatingSearch() {$this->resetPage(pageName: 'p_level');}
    
        // propiedades de busqueda
        public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;
    
        protected function queryString()
        {
            return ['search' => [ 'as' => 'q' ],];
        }

        // propiedades para el modal
        public $showActionModal = false;
        public $showDeleteModal = false;
    
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

                'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
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

        // contar elementos de membresia
        public function countLevels() {
            $amount = count(Level::where('company_id', auth()->user()->company_id)->get());
            $membershipNumber = auth()->user()->company->membership->category;
            if($amount >= $membershipNumber){
                session()->flash('messageError', 'Excede la cantidad permitida');
                return true;
            }
        }

        // eliminar imagen al reemplazarla
        public function deleteImage(){
            if($this->image_hero != ''){
                $path = 'archives/images/level_hero/'.$this->image_hero;
                if(File::exists($path)){
                    File::delete($path);
                }
            }
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
                $this->deleteImage();
                $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id;
                $extension = '.jpg';
                $filename = $name.$extension;

                $image_hero = Image::make($this->image_hero_new);
                $image_hero->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $image_hero->save('archives/images/level_hero/'. $filename);
                $this->image_hero = $filename;
            }
        }
    
    
        // abrir modal y recibir id
        public function openDeleteModal($id){
            $this->level = Level::findOrFail($id);
            $this->authorize('delete', $this->level); 

            $this->resetErrorBag();
            $this->showDeleteModal = true;
        }
        
        // eliminar desde el modal de confirmacion
        public function deleteLevel() {
            $this->resetErrorBag();
            $level = Level::findOrFail($this->level->id);
    
            // comprobar si tiene productos asignados
            if($level->categories->count() > 0){
                session()->flash('messageError', 'No se puede eliminar, tiene categorias asignados');
                $this->reset();
            }else{
                $this->image_hero = $level['image_hero'];
                $this->deleteImage();

                $level->delete();
                session()->flash('messageSuccess', 'Registro eliminado');
                $this->reset();
            }
            
            $this->showDeleteModal = false;
        }
    
        // mostrar modal para confirmar crear
        public function createActionModal() {
            if($this->countLevels()){return;}
            $this->resetErrorBag();
            $this->reset(['level']);
            $this->reset(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'user_id', 'company_id']);

            $this->status = true;
            $this->showActionModal = true;
        }
    
        // // mostrar modal para confirmar editar
        public function editActionModal(Level $level) {
            $this->reset(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'user_id', 'company_id']);

            $this->level = $level;
            $this->authorize('update', $this->level); 

            $this->resetErrorBag();
            
            $this->name = $level['name'];
            $this->slug = $level['slug'];
            $this->description = $level['description'];
            $this->status = $level['status'] == '1' ? true : false;
            $this->image_hero = $level['image_hero'];
            $this->image_hero_uri = $level['image_hero_uri'];
            $this->user_id = $level['user_id'];
            $this->company_id = $level['company_id'];
            $this->showActionModal = true;
        }
    
        // boton de guardar o editar
        public function save() {
        
            $this->status = $this->status ? '1' : '0';
            $this->slug = Str::slug($this->name);
            $this->image_hero_uri = 'archives/images/level_hero/';
            $this->user_id = auth()->user()->id;
            $this->company_id = auth()->user()->company->id;
    
            $this->validate();

            // subir imagen de portada
            $this->uploadImage();
            
            if( isset( $this->level['id'])) {
    
                $this->level->update(
                    $this->only(['name', 'slug', 'description', 'image_hero', 'image_hero_uri', 'status', 'user_id', 'company_id'])
                );

                $this->reset(['level']);
                $this->reset(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'user_id', 'company_id']);
                session()->flash('messageSuccess', 'Actualizado');
    
            } else {
    
                Level::create(
                    $this->only(['name', 'slug', 'description', 'image_hero', 'image_hero_uri', 'status', 'user_id', 'company_id'])
                );
                $this->reset(['level']);
                $this->reset(['name', 'slug', 'description', 'status', 'image_hero', 'image_hero_uri', 'image_hero_new', 'user_id', 'company_id']);
                session()->flash('messageSuccess', 'Guardado');
            }
    
            $this->showActionModal = false;
        }
    public function render()
    {
        $levels = Level::where('company_id', auth()->user()->company_id)
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
        return view('livewire.page.level-index', compact('levels'));
    }
}
