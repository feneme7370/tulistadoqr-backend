<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Page\Membership;

class MembershipIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_membership');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_membership');}

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
    public $category;
    public $level;
    public $product;
    public $user;
    public $suggestion;
    public $status;

    // propiedades para editar
    public $membership;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'category' => ['required', 'numeric'],
            'level' => ['required', 'numeric'],
            'product' => ['required', 'numeric'],
            'user' => ['required', 'numeric'],
            'suggestion' => ['required', 'numeric'],
            'status' => ['numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'category' => 'categoria',
        'level' => 'nivel',
        'product' => 'producto',
        'user' => 'usuario',
        'suggestion' => 'sugerencia',
        'status' => 'estado',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset([
            'name',
            'slug',
            'category',
            'level',
            'product',
            'user',
            'suggestion',
            'status',
        ]);
    }

    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->resetProperties();

        $this->membership = Membership::findOrFail($id);
        $this->authorize('delete', $this->membership); 

        $this->showDeleteModal = true;
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteMembership() {
        $this->resetProperties();

        $membership = Membership::findOrFail($this->membership->id);

        if($membership->companies->count() > 0){
            session()->flash('messageError', 'No se puede eliminar, tiene empresas asignadas');
            $this->resetProperties();
        }else{
            $membership->delete();
            session()->flash('messageSuccess', 'Registro eliminado');
            $this->resetProperties();
        }
        
        $this->showDeleteModal = false;
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetProperties();
        $this->reset(['membership']);
        
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Membership $membership) {
        $this->resetProperties();

        $this->membership = $membership;
        $this->authorize('update', $this->membership); 

        $this->name = $membership['name'];
        $this->slug = $membership['slug'];
        $this->category = $membership['category'];
        $this->level = $membership['level'];
        $this->product = $membership['product'];
        $this->user = $membership['user'];
        $this->suggestion = $membership['suggestion'];
        $this->status = $membership['status'] == '1' ? true : false;

        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);

        // validar datos
        $this->validate();
        
        if( isset( $this->membership['id'])) {

            $this->membership->update(
                $this->only(['name', 'slug', 'category', 'level', 'product', 'user', 'suggestion', 'status'])
            );

            $this->reset(['membership']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            Membership::create(
                $this->only(['name', 'slug', 'category', 'level', 'product', 'user', 'suggestion', 'status'])
            );

            $this->reset(['membership']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $memberships = Membership::when( $this->search, function($query) {
            return $query->where(function( $query) {
                            $query->where('name', 'like', '%'.$this->search . '%');
                        });
                    })
                    ->when($this->active, function( $query) {
                        return $query->where('status', 1);
                    })
                    ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                    ->paginate($this->perPage, pageName: 'p_membership');

        return view('livewire.page.membership-index', compact('memberships'));
    }
}
