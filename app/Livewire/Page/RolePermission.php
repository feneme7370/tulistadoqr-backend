<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class RolePermission extends Component
{
    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showDeleteModal = false;

    // propiedades del form
    public $name;
    public $guard_name;

    // propiedades para editar
    public $permission;
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
        $this->reset(['name', 'guard_name']);
    }

    ///////////////////////////// CRUD /////////////////////////////
    // eliminar desde sweetalert
    protected $listeners = ['deletePermissionId'];
    public function deletePermissionId($id){
        $this->resetProperties();

        $this->permission = Permission::findOrFail($id);
        $this->authorize('delete', $this->permission); 

        // $this->permission->roles();
        $this->permission->delete();

        $this->resetProperties();
        $this->reset('permission');
        // session()->flash('messageSuccess', 'Registro eliminado');
        $this->dispatch('toastrSuccess', 'Eliminado con exito');
        // }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetProperties();
        $this->reset(['permission']);

        $this->authorize('create', Permission::class); 

        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Permission $permission) {
        $this->resetProperties();

        $this->permission = $permission;
        $this->authorize('update', $this->permission); 
        
        $this->name = $permission['name'];
        $this->guard_name = $permission['guard_name'];

        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // validar datos
        $this->validate();

        if( isset( $this->permission['id'])) {

            // editar datos
            $this->permission->update(
                $this->only(['name', 'guard_name'])
            );

            $this->reset(['permission']);
            $this->resetProperties();
            // session()->flash('messageSuccess', 'Actualizado con exito');
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            Permission::create(
                $this->only(['name', 'guard_name'])
            );

            $this->reset(['permission']);
            $this->resetProperties();
            // session()->flash('messageSuccess', 'Guardado con exito');
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }

    public function render()
    {
        $permissions = Permission::paginate(50);
        return view('livewire.page.role-permission', compact(
            'permissions',
        ));
    }
}
