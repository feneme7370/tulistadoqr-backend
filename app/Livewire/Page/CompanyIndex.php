<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Page\Membership;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\helpers\sistem\CrudInterventionImage;

class CompanyIndex extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_company');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_company');}

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
    public $email;
    public $phone;
    public $adress;
    public $city;
    public $social;
    public $url;
    public $description;
    public $status;
    public $image_qr;
    public $image_qr_uri;
    public $image_logo;
    public $image_logo_uri;
    public $image_hero;
    public $image_hero_uri;
    public $image_qr_new;
    public $image_logo_new;
    public $image_hero_new;
    public $membership_id;

    // propiedades para editar
    public $company;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:2', Rule::unique('companies')->ignore($this->company)],
            'slug' => ['required', 'string', Rule::unique('companies')->ignore($this->company)],
            'email' => ['required', 'email', 'min:2', Rule::unique('companies')->ignore($this->company)],
            'phone' => ['nullable', 'numeric', 'min:2'],
            'adress' => ['nullable', 'string', 'min:2'],
            'city' => ['nullable', 'string', 'min:2'],
            'social' => ['nullable', 'string', 'min:2'],
            'url' => ['nullable', 'string', 'min:2'],
            'description' => ['nullable', 'string', 'min:2'],
            'image_qr' => ['nullable', 'string'],
            'image_qr_uri' => ['nullable', 'string'],
            'image_logo' => ['nullable', 'string'],
            'image_logo_uri' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'image_hero_uri' => ['nullable', 'string'],
            'image_qr_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
            'image_logo_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
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
        'url' => 'url',
        'description' => 'descripcion',
        'image_qr' => 'imagen del qr',
        'image_qr_uri' => 'uri imagen del qr',
        'image_logo' => 'imagen del logo',
        'image_logo_uri' => 'uri imagen del logo',
        'image_hero' => 'imagen de portada',
        'image_hero_uri' => 'uri imagen de portada',
        'status' => 'estado',
        'membership_id' => 'membresia',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset([    
            'name',
            'slug',
            'email',
            'phone',
            'adress',
            'city',
            'social',
            'url',
            'description',
            'status',
            'image_qr',
            'image_qr_uri',
            'image_logo',
            'image_logo_uri',
            'image_hero',
            'image_hero_uri',
            'image_qr_new',
            'image_logo_new',
            'image_hero_new',
            'membership_id',
        ]);
    }
    
    ///////////////////////////// MODULO IMAGENES /////////////////////////////

    // eliminar imagen al reemplazarla
    public function deleteImage(){
        CrudInterventionImage::deleteImage(
            $this->image_hero, 
            'archives/images/hero/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageEdit() {
        $this->deleteImage();
        $this->image_hero = '';
        $this->level->update(
            $this->only(['image_hero'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImage(){

        // crear o reemplazar imagen
        if($this->image_hero_new){
            $this->image_hero = CrudInterventionImage::uploadImage(
                $this->image_hero, 
                'archives/images/hero/', 
                $this->image_hero_new
            );
        }
    }

    // eliminar imagen al reemplazarla
    public function deleteImageLogo(){
        CrudInterventionImage::deleteImage(
            $this->image_logo, 
            'archives/images/logo/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageLogoEdit() {
        $this->deleteImage();
        $this->image_logo = '';
        $this->level->update(
            $this->only(['image_logo'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImageLogo(){

        // crear o reemplazar imagen
        if($this->image_logo_new){
            $this->image_logo = CrudInterventionImage::uploadImage(
                $this->image_logo, 
                'archives/images/logo/', 
                $this->image_logo_new
            );
        }
    }

    // eliminar imagen al reemplazarla
    public function deleteImageQr(){
        CrudInterventionImage::deleteImage(
            $this->image_qr, 
            'archives/images/qr/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageQrEdit() {
        $this->deleteImage();
        $this->image_qr = '';
        $this->level->update(
            $this->only(['image_qr'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImageQr(){

        // crear o reemplazar imagen
        if($this->image_qr_new){
            $this->image_qr = CrudInterventionImage::uploadImage(
                $this->image_qr, 
                'archives/images/qr/', 
                $this->image_qr_new
            );
        }
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->resetProperties();

        $this->company = Company::findOrFail($id);
        $this->authorize('delete', $this->company); 

        $this->showDeleteModal = true;
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteCompany() {
        $this->resetProperties();

        $company = Company::findOrFail($this->company->id);

        // validar company principal
        if($company->id == 1){
            session()->flash('messageError', 'No se puede eliminar el registro');
            $this->showDeleteModal = false;
        }else{

            $this->deleteImage();
            $this->deleteImageLogo();
            $this->deleteImageQr();
            $company->delete();

            $this->resetProperties();
            session()->flash('messageSuccess', 'Registro eliminado');
            
            $this->showDeleteModal = false;
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetProperties();
        $this->reset(['company']);

        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Company $company) {
        $this->resetProperties();

        $this->company = $company;
        $this->authorize('update', $this->company); 

        $this->name = $company['name'];
        $this->slug = $company['slug'];
        $this->email = $company['email'];
        $this->phone = $company['phone'];
        $this->adress = $company['adress'];
        $this->city = $company['city'];
        $this->social = $company['social'];
        $this->url = $company['url'];
        $this->description = $company['description'];
        $this->image_qr = $company['image_qr'];
        $this->image_logo = $company['image_logo'];
        $this->image_hero = $company['image_hero'];
        $this->status = $company['status'] == '1' ? true : false;
        $this->membership_id = $company['membership_id'];
        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        $this->image_qr_uri = 'archives/images/qr/';
        $this->image_logo_uri = 'archives/images/logo/';
        $this->image_hero_uri = 'archives/images/hero/';

        // validar datos
        $this->validate();

        // subir imagen de portada
        $this->uploadImage();
        $this->uploadImageLogo();
        $this->uploadImageQr();
        
        if( isset( $this->company['id'])) {

            $this->company->update(
                $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'url', 'description', 'image_qr', 'image_qr_uri', 'image_logo', 'image_logo_uri', 'image_hero', 'image_hero_uri', 'status', 'membership_id'])
            );

            $this->reset(['company']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Actualizado con exito');

        } else {

            Company::create(
                $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'url', 'description', 'image_qr', 'image_qr_uri', 'image_logo', 'image_logo_uri', 'image_hero', 'image_hero_uri', 'status', 'membership_id'])
            );

            $this->reset(['company']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Guardado con exito');
        }

        $this->showActionModal = false;
    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
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
                        ->paginate($this->perPage, pageName: 'p_company');
                        
        return view('livewire.page.company-index', compact('companies', 'memberships'));
    }
}
