<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showDeleteModal = false;

    // propiedades del form
    public $name;
    public $guard_name;

    // propiedades para editar
    public $role;
    public $role_permissions = [];

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'guard_name' => ['required', 'string'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'guard_name' => 'guard_name',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'guard_name', 'role_permissions']);
    }

    ///////////////////////////// CRUD /////////////////////////////
    // eliminar desde sweetalert
    protected $listeners = ['deleteRoleId'];
    public function deleteRoleId($id){
        $this->resetProperties();

        $this->role = Role::findOrFail($id);
        $this->authorize('delete', $this->role); 

        $this->role->delete();

        $this->resetProperties();
        $this->reset('role');
        $this->dispatch('toastrSuccess', 'Eliminado con exito');
        // }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {

        $this->resetProperties();
        $this->reset(['role']);

        $this->authorize('create', Role::class); 

        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Role $role) {
        $this->resetProperties();

        $this->role = $role;
        $this->authorize('update', $this->role); 
        
        $this->name = $role['name'];
        $this->guard_name = $role['guard_name'];

        $this->role_permissions = $this->role->permissions->pluck('id')->toArray();

        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // validar datos
        $this->validate();

        if( isset( $this->role['id'])) {

            // editar datos
            $this->role->update(
                $this->only(['name', 'guard_name'])
            );

            $this->role->permissions()->sync($this->role_permissions);

            $this->reset(['role']);
            $this->resetProperties();
            // session()->flash('messageSuccess', 'Actualizado con exito');
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            $role = Role::create(
                $this->only(['name', 'guard_name'])
            );

            $role->permissions()->sync($this->role_permissions);

            $this->reset(['role']);
            $this->resetProperties();
            // session()->flash('messageSuccess', 'Guardado con exito');
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }

    public function render()
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $roles = Role::paginate(10);
        return view('livewire.page.role-index', compact(
            'roles',
            'permissions',
        ));
    }
}
