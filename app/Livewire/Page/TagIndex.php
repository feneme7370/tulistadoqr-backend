<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Tag;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TagIndex extends Component
{
    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage();}
    public function updatingSearch() {$this->resetPage();}

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

    // propiedades para el modal
    public $showActionModal = false;
    public $showDeleteModal = false;

    // propiedades del form
    public $name;
    public $slug;
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $tag;

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:4'],
            'slug' => ['required', 'string', 'min:4'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'user_id' => 'usuario',
        'company_id' => 'empresa',
    ];


    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->showDeleteModal = true;
        $this->tag = Tag::findOrFail($id);
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteTag() {
        $this->resetErrorBag();
        $tag = Tag::findOrFail($this->tag->id);

        $tag->delete();
        session()->flash('messageSuccess', 'Registro eliminado');
        $this->reset();
        
        $this->showDeleteModal = false;
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetErrorBag();
        $this->reset(['tag']);
        $this->reset(['name', 'slug', 'user_id', 'company_id']);
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Tag $tag) {
        $this->resetErrorBag();
        $this->tag = $tag;
        $this->name = $tag['name'];
        $this->slug = $tag['slug'];
        $this->user_id = $tag['user_id'];
        $this->company_id = $tag['company_id'];
        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        $this->validate();
        
        if( isset( $this->tag['id'])) {

            $this->tag->update(
                $this->only(['name', 'slug', 'user_id', 'company_id'])
            );
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            Tag::create(
                $this->only(['name', 'slug', 'user_id', 'company_id'])
            );
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }
    
    public function render()
    {
        $tags = Tag::where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage);
        return view('livewire.page.tag-index', compact('tags'));
    }
}
