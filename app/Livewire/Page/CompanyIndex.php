<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use Livewire\WithPagination;
use App\Models\Page\Membership;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;

class CompanyIndex extends Component
{
    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_company');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_company');}

    use WithFileUploads;
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


    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->showDeleteModal = true;
        $this->company = Company::findOrFail($id);
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteCompany() {
        $company = Company::findOrFail($this->company->id);
        $this->authorize('delete', $company); 

        $this->resetErrorBag();

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

    // eliminar imagen de portada
    public function deleteImage(){
        if($this->image_hero != ''){
            $path = 'archives/images/hero/'.$this->image_hero;
            if(File::exists($path)){
                File::delete($path);
            }
        }
    }
    // eliminar imagen del logo
    public function deleteImageLogo(){
        if($this->image_logo != ''){
            $path = 'archives/images/logo/'.$this->image_logo;
            if(File::exists($path)){
                File::delete($path);
            }
        }
    }
    // eliminar imagen del QR
    public function deleteImageQR(){
        if($this->image_qr != ''){
            $path = 'archives/images/qr/'.$this->image_qr;
            if(File::exists($path)){
                File::delete($path);
            }
        }
    }

    public function deleteImageEdit() {
        $this->deleteImage();
        $this->image_hero = '';
        $this->company->update(
            $this->only(['image_hero'])
        );
    }

    public function deleteImageLogoEdit() {
        $this->deleteImageLogo();
        $this->image_logo = '';
        $this->company->update(
            $this->only(['image_logo'])
        );
    }

    public function deleteImageQrEdit() {
        $this->deleteImageQr();
        $this->image_qr = '';
        $this->company->update(
            $this->only(['image_qr'])
        );
    }

    // subir imagen de portada a la empresa
    public function uploadImage(){

        // crear o reemplazar imagen
        if($this->image_hero_new){
            $this->deleteImage();
            $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id;
            $extension = '.jpg';
            $filename = $name.$extension;

            $image_hero = Image::make($this->image_hero_new);
            $image_hero->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = public_path('archives/images/hero/') . $filename;
            $image_hero->save($path);
            $this->image_hero = $filename;
        }
    }

    // subir logo a la empresa
    public function uploadImageLogo(){
    
        // Verificar si la carpeta existe, si no, crearla

        // crear o reemplazar imagen
        if($this->image_logo_new){
            $this->deleteImageLogo();
            $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id;
            $extension = '.jpg';
            $filename = $name.$extension;
            
            $image_logo = Image::make($this->image_logo_new);
            $image_logo->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = 'archives/images/logo/' . $filename;
            $image_logo->save($path);

            $this->image_logo = $filename;
        }
    }

    // subir qr a la empresa
    public function uploadImageQr(){
    
        // Verificar si la carpeta existe, si no, crearla

        // crear o reemplazar imagen
        if($this->image_qr_new){
            $this->deleteImageQr();
            $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id;
            $extension = '.jpg';
            $filename = $name.$extension;
            
            $image_qr = Image::make($this->image_qr_new);
            $image_qr->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $path = 'archives/images/qr/' . $filename;
            $image_qr->save($path);

            $this->image_qr = $filename;
        }
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->resetErrorBag();
        $this->reset(['company']);
        $this->reset(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'url', 'description', 'image_qr', 'image_qr_new', 'image_logo', 'image_logo_new', 'image_hero', 'image_hero_new', 'status', 'membership_id']);
        $this->status = true;
        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(Company $company) {
        $this->reset(['company']);
        $this->reset(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'url', 'description', 'image_qr', 'image_qr_new', 'image_logo', 'image_logo_new', 'image_hero', 'image_hero_new', 'status', 'membership_id']);

        $this->company = $company;
        $this->authorize('update', $this->company); 

        $this->resetErrorBag();
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
    
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        $this->image_qr_uri = 'archives/images/qr/';
        $this->image_logo_uri = 'archives/images/logo/';
        $this->image_hero_uri = 'archives/images/hero/';

        $this->validate();

        $this->uploadImage();
        $this->uploadImageLogo();
        $this->uploadImageQr();
        
        if( isset( $this->company['id'])) {

            $this->company->update(
                $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'url', 'description', 'image_qr', 'image_qr_uri', 'image_logo', 'image_logo_uri', 'image_hero', 'image_hero_uri', 'status', 'membership_id'])
            );
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            Company::create(
                $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'url', 'description', 'image_qr', 'image_qr_uri', 'image_logo', 'image_logo_uri', 'image_hero', 'image_hero_uri', 'status', 'membership_id'])
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
                        ->paginate($this->perPage, pageName: 'p_company');
        return view('livewire.page.company-index', compact('companies', 'memberships'));
    }
}
