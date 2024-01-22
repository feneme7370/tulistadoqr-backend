<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use Livewire\WithPagination;
use App\Models\Page\Membership;

class CompanyIndex extends Component
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
    public $email;
    public $phone;
    public $adress;
    public $city;
    public $social;
    public $description;
    public $status;
    public $image_logo;
    public $image_hero;
    public $membership_id;

    // propiedades para editar
    public $company;

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string'],
            'email' => ['required', 'email', 'min:2'],
            'phone' => ['nullable', 'numeric', 'min:2'],
            'adress' => ['nullable', 'string', 'min:2'],
            'city' => ['nullable', 'string', 'min:2'],
            'social' => ['nullable', 'string', 'min:2'],
            'description' => ['nullable', 'string', 'min:2'],
            'image_logo' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'status' => ['numeric'],
            'membership_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'email' => 'email',
        'phone' => 'telefono',
        'adress' => 'direccion',
        'city' => 'ciudad',
        'social' => 'redes sociales',
        'description' => 'descripcion',
        'image_logo' => 'imagen del logo',
        'image_hero' => 'imagen de portada',
        'status' => 'estado',
        'membership_id' => 'membresia',
    ];


    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->showDeleteModal = true;
        $this->company = Company::findOrFail($id);
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteCompany() {
        $this->resetErrorBag();
        $company = Company::findOrFail($this->company->id);

        if($company->id == 1){
            session()->flash('messageError', 'No se puede eliminar el registro');
            $this->showDeleteModal = false;
        }else{
            $company->delete();
            session()->flash('messageSuccess', 'Registro eliminado');
            $this->reset();
            
            $this->showDeleteModal = false;
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetErrorBag();
        $this->reset(['company']);
        $this->reset(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'description', 'image_logo', 'image_hero', 'status', 'membership_id']);
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Company $company) {
        $this->resetErrorBag();
        $this->company = $company;
        $this->name = $company['name'];
        $this->slug = $company['slug'];
        $this->email = $company['email'];
        $this->phone = $company['phone'];
        $this->adress = $company['adress'];
        $this->city = $company['city'];
        $this->social = $company['social'];
        $this->description = $company['description'];
        $this->image_logo = $company['image_logo'];
        $this->image_hero = $company['image_hero'];
        $this->status = $company['status'] == '1' ? true : false;
        $this->membership_id = $company['membership_id'];
        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);

        $this->validate();
        
        if( isset( $this->company['id'])) {

            $this->company->update(
                $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'description', 'image_logo', 'image_hero', 'status', 'membership_id'])
            );
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            Company::create(
                $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'description', 'image_logo', 'image_hero', 'status', 'membership_id'])
            );
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }

    public function render()
    {
        $memberships = Membership::get();
        $companies = Company::when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%')
                                        ->orWhere('email', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage);
        return view('livewire.page.company-index', compact('companies', 'memberships'));
    }
}
