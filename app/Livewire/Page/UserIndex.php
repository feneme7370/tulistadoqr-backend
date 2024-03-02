<?php

namespace App\Livewire\Page;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_user');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_user');}

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

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string'],
            'email' => ['required', 'email', 'min:2', Rule::unique('users')->ignore($this->user)],
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

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
            'slug',
            'lastname',
            'phone',
            'adress',
            'birthday',
            'city',
            'social',
            'description',
            'status',
            'company_id',
        ]);
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteUserId'];
    public function deleteUserId($id){
        $this->resetProperties();

        $this->user = User::findOrFail($id);

        $this->authorize('delete', $this->user); 

        $this->user->delete();

        $this->resetProperties();
        $this->reset('user');
        // session()->flash('messageSuccess', 'Registro eliminado');
        $this->dispatch('toastrSuccess', 'Eliminado con exito');
        // }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->reset(['user']);
        $this->resetProperties();

        $this->authorize('create', User::class); 

        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(User $user) {
        $this->resetProperties();

        $this->user = $user;
        $this->authorize('update', $this->user); 

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
    
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
    
        // validar datos
        $this->validate();

        if( isset( $this->user['id'])) {

            // crear password nuevo o dejar el existente
            if($this->password){
                $this->password = Hash::make($this->password);
            }else{
                $this->password = $this->user->password;
            }

            $this->user->update(
                $this->only(['name', 'slug', 'email', 'password', 'lastname', 'phone', 'adress', 'birthday', 'city', 'social', 'description', 'status', 'company_id'])
            );

            $this->reset(['user']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            // validar password no nulo para crear usuario
            $this->validate(['password' => ['required', 'min:2', 'confirmed']]);

            // crear password nuevo o dejar el existente
            if($this->password){
                $this->password = Hash::make($this->password);
            }

            $userCreated = User::create(
                $this->only(['name', 'slug', 'email', 'password', 'lastname', 'phone', 'adress', 'birthday', 'city', 'social', 'description', 'status', 'company_id'])
            );

            $userCreated->assignRole(['employee']);

            $this->reset(['user']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
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
                        ->paginate($this->perPage, pageName: 'p_user');
                        
        return view('livewire.page.user-index', compact('companies', 'users'));
    }
}
