<?php

namespace App\Livewire\Page;

use App\Models\Page\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ClientIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_client');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_client');}

    // propiedades de busqueda
    public $active = true, $search = '', $sortBy = 'id', $sortAsc = false, $perPage = 10;

    // mostrar variables en queryString
    protected function queryString(){
        return ['search' => [ 'as' => 'q' ],];
    }

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $showActionModal = false;
    public $showViewModal = false;

    // propiedades del form
    public $name;
    public $lastname;
    public $phone;
    public $adress;
    public $city;
    public $country;
    public $email;
    public $description;

    public $status;

    public $user_id;
    public $company_id;

    // propiedades para editar
    public $client;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'lastname' => ['required', 'string', 'min:3'],
            'phone' => ['nullable', 'string', 'min:3'],
            'adress' => ['nullable', 'string', 'min:3'],
            'city' => ['nullable', 'string', 'min:3'],
            'country' => ['nullable', 'string', 'min:3'],
            'email' => ['nullable', 'string', 'min:3'],

            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['numeric'],

            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'lastname' => 'apellido',
        'phone' => 'celular',
        'adress' => 'direccion',
        'city' => 'ciudad',
        'country' => 'pais',
        'email' => 'email',

        'description' => 'descripcion',
        'status' => 'estado',

        'user_id' => 'usuario',
        'company_id' => 'empresa',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'lastname', 'phone', 'adress', 'city', 'country', 'email', 'description', 'status', 'user_id', 'company_id']);
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // eliminar desde sweetalert
    protected $listeners = ['deleteClientId'];
    public function deleteClientId($id){
        $this->resetProperties();

        $this->client = Client::findOrFail($id);
        $this->authorize('delete', $this->client); 

        // comprobar si tiene productos asignados
        if($this->client->orders->count() > 0){
            session()->flash('messageError', 'No se puede eliminar, tiene ordenes asignadas');
            $this->resetProperties();
        }else{
 
            $this->client->delete();

            $this->resetProperties();
            $this->reset('client');

            $this->dispatch('toastrSuccess', 'Eliminado con exito');
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {      
        $this->resetProperties();
        $this->reset(['client']);

        $this->status = true;
        $this->showActionModal = true;
    }

    // cargar datos a editar
    public function preloadEditModal($item){
        $this->name = $item['name'];
        $this->lastname = $item['lastname'];
        $this->phone = $item['phone'];
        $this->adress = $item['adress'];
        $this->city = $item['city'];
        $this->country = $item['country'];
        $this->email = $item['email'];

        $this->description = $item['description'];
        $this->status = $item['status'] == '1' ? true : false;

        $this->user_id = $item['user_id'];
        $this->company_id = $item['company_id'];
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Client $client) {
        $this->resetProperties();

        $this->client = $client;

        $this->authorize('update', $this->client); 
        
        $this->resetErrorBag();

        $this->preloadEditModal($this->client);

        $this->showActionModal = true;
    }

    public function viewActionModal(Client $client){
        $this->resetProperties();
        $this->resetErrorBag();

        $this->client = $client;
        
        $this->authorize('update', $this->client);         

        $this->preloadEditModal($this->client);
        
        $this->showViewModal = true;
    }

    // boton de guardar o editar
    public function save() {
        
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar datos
        $this->validate();

        if( isset( $this->client['id'])) {

            // editar datos
            $this->client->update(
                $this->only(['name', 'lastname', 'phone', 'adress', 'city', 'country', 'email', 'description', 'status', 'user_id', 'company_id'])
            );

            $this->reset(['client']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Actualizado con exito');

        } else {

            // crear datos
            Client::create(
                $this->only(['name', 'lastname', 'phone', 'adress', 'city', 'country', 'email', 'description', 'status', 'user_id', 'company_id'])
            );

            $this->reset(['client']);
            $this->resetProperties();
            
            $this->dispatch('toastrSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }

    public function render()
    {
        $clients = Client::select('id', 'name', 'lastname', 'phone', 'adress', 'city', 'country', 'email', 'description', 'status', 'user_id', 'company_id')
        ->with('user', 'company')
        ->where('company_id', auth()->user()->company_id)
        ->when( $this->search, function($query) {
            return $query->where(function( $query) {
                $query->where('name', 'like', '%'.$this->search . '%')
                        ->orWhere('lastname', 'like', '%'.$this->search . '%');
            });
        })
        ->when($this->active, function( $query) {
            return $query->where('status', 1);
        })
        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
        ->paginate($this->perPage, pageName: 'p_client');

        $client = $this->client;

        return view('livewire.page.client-index', compact(
        'clients', 
        'client'
        ));
    }
}
