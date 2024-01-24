<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Page\Category;

class CategoryIndex extends Component
{
    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_category');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_category');}

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
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $category;

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
    public function countCategories() {
        $amount = count(Category::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->category;
        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida');
            return true;
        }
    }

    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->category = Category::findOrFail($id);
        $this->authorize('delete', $this->category); 
        
        $this->resetErrorBag();
        $this->showDeleteModal = true;
        
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteCategory() {
        $this->resetErrorBag();
        $category = Category::findOrFail($this->category->id);

        // comprobar si tiene productos asignados
        if($category->products->count() > 0){
            session()->flash('messageError', 'No se puede eliminar, tiene productos asignados');
            $this->reset();
        }else{
            $category->delete();
            session()->flash('messageSuccess', 'Registro eliminado');
            $this->reset();
        }
        
        $this->showDeleteModal = false;
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        if($this->countCategories()){return;}
        $this->resetErrorBag();
        $this->reset(['category']);
        $this->reset(['name', 'slug', 'description', 'status', 'user_id', 'company_id']);
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Category $category) {
        $this->category = $category;
        $this->authorize('update', $this->category); 

        $this->resetErrorBag();

        $this->name = $category['name'];
        $this->slug = $category['slug'];
        $this->description = $category['description'];
        $this->status = $category['status'] == '1' ? true : false;
        $this->user_id = $category['user_id'];
        $this->company_id = $category['company_id'];
        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);

        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        $this->validate();
        
        if( isset( $this->category['id'])) {

            $this->category->update(
                $this->only(['name', 'slug', 'description', 'status', 'user_id', 'company_id'])
            );
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            Category::create(
                $this->only(['name', 'slug', 'description', 'status', 'user_id', 'company_id'])
            );
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }

    public function render()
    {
        $categories = Category::where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_category');
        return view('livewire.page.category-index', compact('categories'));
    }
}