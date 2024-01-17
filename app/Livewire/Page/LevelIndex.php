<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class LevelIndex extends Component
{
        // paginacion
        use WithPagination;
        public function updatingActive() {$this->resetPage();}
        public function updatingSearch() {$this->resetPage();}
    
        // propiedades de busqueda
        public $active = true, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;
    
        // propiedades para el modal
        public $showActionModal = false;
        public $showDeleteModal = false;
    
        // propiedades del form
        public $name;
        public $slug;
        public $description;
        public $status;
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
                'user_id' => ['required', 'numeric'],
                'company_id' => ['required', 'numeric'],
            ];
        }
    
        // renombrar variables a castellano
        protected $validationAttributes = [
            'name' => 'nombre',
            'slug' => 'slug',
            'description' => 'descripcion',
            'status' => 'estado',
            'user_id' => 'usuario',
            'company_id' => 'empresa',
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
    
    
        // abrir modal y recibir id
        public function openDeleteModal($id){
            $this->showDeleteModal = true;
            $this->level = Level::findOrFail($id);
        }
        
        // eliminar desde el modal de confirmacion
        public function deleteLevel() {
            $level = Level::findOrFail($this->level->id);
    
            // if($level->companies->count() > 0){
            //     session()->flash('messageError', 'No se puede eliminar, tiene empresas asignadas');
            //     $this->reset();
            // }else{
            //     $level->delete();
            //     session()->flash('messageSuccess', 'Registro eliminado');
            //     $this->reset();
            // }
            $level->delete();
            session()->flash('messageSuccess', 'Registro eliminado');
            $this->reset();
            
            $this->showDeleteModal = false;
        }
    
        // mostrar modal para confirmar crear
        public function createActionModal() {
            if($this->countLevels()){return;}
            $this->reset(['level']);
            $this->reset(['name', 'slug', 'description', 'status', 'user_id', 'company_id']);
            $this->status = true;
            $this->showActionModal = true;
        }
    
        // // mostrar modal para confirmar editar
        public function editActionModal(Level $level) {
            $this->level = $level;
            $this->name = $level['name'];
            $this->slug = $level['slug'];
            $this->description = $level['description'];
            $this->status = $level['status'] == '1' ? true : false;
            $this->user_id = $level['user_id'];
            $this->company_id = $level['company_id'];
            $this->showActionModal = true;
        }
    
        // boton de guardar o editar
        public function save() {
        
            $this->status = $this->status ? '1' : '0';
            $this->slug = Str::slug($this->name);

            $this->user_id = auth()->user()->id;
            $this->company_id = auth()->user()->company->id;
    
            $this->validate();
            
            if( isset( $this->level['id'])) {
    
                $this->level->update(
                    $this->only(['name', 'slug', 'description', 'status', 'user_id', 'company_id'])
                );
                session()->flash('messageSuccess', 'Actualizado');
    
            } else {
    
                Level::create(
                    $this->only(['name', 'slug', 'description', 'status', 'user_id', 'company_id'])
                );
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
                        ->paginate($this->perPage);
        return view('livewire.page.level-index', compact('levels'));
    }
}
