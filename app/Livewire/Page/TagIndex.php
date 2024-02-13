<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Tag;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class TagIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_tag');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_tag');}

    // propiedades de busqueda
    public $active = false, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

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
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $tag;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

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

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // contar elementos de niveles
    public function countTags() {
        $amount = count(Tag::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->tag;
        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida');
            return true;
        }
    }

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'user_id', 'company_id']);
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // abrir modal y recibir id
    // public function openDeleteModal($id){
    //     $this->resetProperties();

    //     $this->tag = Tag::findOrFail($id);
    //     $this->authorize('delete', $this->tag); 

    //     $this->showDeleteModal = true;
    // }
    
    // eliminar desde el modal de confirmacion
    // public function deleteTag() {
    //     $this->resetProperties();

    //     $tag = Tag::findOrFail($this->tag->id);
    //     $tag->delete();

    //     session()->flash('messageSuccess', 'Registro eliminado');
    //     $this->resetProperties();
    //     $this->reset('tag');

    //     $this->showDeleteModal = false;
    // }

    // eliminar desde sweetalert
    protected $listeners = ['deleteTagId'];
    public function deleteTagId($id){
        $this->resetProperties();

        $this->tag = Tag::findOrFail($id);
        $this->authorize('delete', $this->tag); 

        $this->tag->delete();

        $this->resetProperties();
        $this->reset('tag');
        // session()->flash('messageSuccess', 'Registro eliminado');
        $this->dispatch('toastifyTag', 'Eliminado con exito');

    }
    
    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countTags()){return;}

        $this->reset(['tag']);
        $this->resetProperties();

        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Tag $tag) {
        $this->resetProperties();

        $this->tag = $tag;
        $this->authorize('update', $this->tag); 

        $this->name = $tag['name'];
        $this->slug = $tag['slug'];
        $this->user_id = $tag['user_id'];
        $this->company_id = $tag['company_id'];

        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar datos
        $this->validate();
        
        if( isset( $this->tag['id'])) {

            // editar datos
            $this->tag->update(
                $this->only(['name', 'slug', 'user_id', 'company_id'])
            );

            $this->reset(['tag']);
            $this->resetProperties();
            // session()->flash('messageSuccess', 'Actualizado con exito');
            $this->dispatch('toastifyTag', 'Actualizado con exito');

        } else {

            // crear datos
            Tag::create(
                $this->only(['name', 'slug', 'user_id', 'company_id'])
            );

            $this->reset(['tag']);
            $this->resetProperties();
            // session()->flash('messageSuccess', 'Guardado con exito');
            $this->dispatch('toastifyTag', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }
    
    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $tags = Tag::where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_tag');
                        
        return view('livewire.page.tag-index', compact('tags'));
    }
}
