<?php

namespace App\Livewire\Page;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
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
    public $email;
    public $password;
    public $password_confirmation;
    public $slug;
    public $lastname;
    public $phone;
    public $adress;
    public $birthday;
    public $city;
    public $social;
    public $description;
    public $status;
    public $company_id;

    // propiedades para editar
    public $user;

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string'],
            'email' => ['required', 'email', 'min:2'],
            'password' => ['nullable', 'min:2', 'confirmed'],
            'password_confirmation' => ['nullable', 'min:2'],
            'lastname' => ['required', 'string', 'min:2'],
            'phone' => ['nullable', 'numeric', 'min:2'],
            'adress' => ['nullable', 'string', 'min:2'],
            'birthday' => ['nullable', 'string', 'min:2'],
            'city' => ['nullable', 'string', 'min:2'],
            'social' => ['nullable', 'string', 'min:2'],
            'description' => ['nullable', 'string', 'min:2'],
            'status' => ['numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'email' => 'email',
        'password' => 'clave',
        'password_confirmation' => 'repetir clave',
        'lastname' => 'apellido',
        'phone' => 'telefono',
        'adress' => 'direccion',
        'birthday' => 'fecha de nacimiento',
        'city' => 'ciudad',
        'social' => 'redes sociales',
        'description' => 'descripcion',
        'status' => 'estado',
        'company_id' => 'empresa',
    ];


    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->showDeleteModal = true;
        $this->user = User::findOrFail($id);
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteUser() {
        $this->resetErrorBag();
        $user = User::findOrFail($this->user->id);

        if($user->id == 1){
            session()->flash('messageError', 'No se puede eliminar el registro');
            $this->showDeleteModal = false;
        }else{
            $user->delete();
            session()->flash('messageSuccess', 'Registro eliminado');
            $this->reset();
            
            $this->showDeleteModal = false;
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetErrorBag();
        $this->reset(['user']);
        $this->reset(['name', 'slug', 'email', 'password', 'password_confirmation', 'lastname', 'phone', 'adress', 'birthday', 'city', 'social', 'description', 'status', 'company_id']);
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(User $user) {
        $this->resetErrorBag();
        $this->reset(['user']);
        $this->reset(['name', 'slug', 'email', 'password', 'password_confirmation', 'lastname', 'phone', 'adress', 'birthday', 'city', 'social', 'description', 'status', 'company_id']);

        $this->user = $user;
        $this->name = $user['name'];
        $this->slug = $user['slug'];
        $this->email = $user['email'];
        $this->lastname = $user['lastname'];
        $this->phone = $user['phone'];
        $this->adress = $user['adress'];
        $this->birthday = $user['birthday'];
        $this->city = $user['city'];
        $this->social = $user['social'];
        $this->description = $user['description'];
        $this->status = $user['status'] == '1' ? true : false;
        $this->company_id = $user['company_id'];
        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        

        $this->validate();

        if($this->password){
            $this->password = Hash::make($this->password);
        }else{
            $this->password = $this->user->password;
        }
        
        if( isset( $this->user['id'])) {

            $this->user->update(
                $this->only(['name', 'slug', 'email', 'password', 'lastname', 'phone', 'adress', 'birthday', 'city', 'social', 'description', 'status', 'company_id'])
            );
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            User::create(
                $this->only(['name', 'slug', 'email', 'password', 'lastname', 'phone', 'adress', 'birthday', 'city', 'social', 'description', 'status', 'company_id'])
            );
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }
    public function render()
    {
        $companies = Company::get();
        $users = User::when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%')
                                        ->orWhere('lastname', 'like', '%'.$this->search . '%')
                                        ->orWhere('email', 'like', '%'.$this->search . '%')
                                        ->orWhereHas('company', function ($q) {
                                            $q->where('name', 'like', '%'.$this->search . '%');
                                        });
                            });
                        })
                        ->when($this->active, function( $query) {
                            return $query->where('status', 1);
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage);
        return view('livewire.page.user-index', compact('companies', 'users'));
    }
}
