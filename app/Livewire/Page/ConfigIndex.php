<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use App\Models\Page\SocialMedia;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\helpers\sistem\CrudInterventionImage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ConfigIndex extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////

    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades del form
    public $name;
    public $slug;
    public $email;
    public $phone;
    public $adress;
    public $city;
    public $social;
    public $times_description;
    public $short_description;
    public $description;
    public $type_menu;
    public $image_qr;
    public $image_qr_uri;
    public $image_logo;
    public $image_logo_uri;
    public $image_hero;
    public $image_hero_uri;

    public $image_logo_new;
    public $image_hero_new;
    
    // propiedades para editar
    public $company;
    public $dataImage;
    public $dataImageLogo;
    
    public $company_data;
    public $socialMedia;
    public $socialMediaData = [];

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
            'times_description' => ['nullable', 'string', 'min:2'],
            'short_description' => ['nullable', 'string', 'min:2'],
            'description' => ['nullable', 'string', 'min:2'],
            'type_menu' => ['nullable', 'numeric'],
            'image_logo' => ['nullable', 'string'],
            'image_logo_uri' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'image_hero_uri' => ['nullable', 'string'],
            'image_logo_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
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
        'times_description' => 'descripcion de horarios',
        'short_description' => 'breve descripcion',
        'description' => 'descripcion',
        'type_menu' => 'tipo de menu',
        'image_logo' => 'imagen del logo',
        'image_logo_uri' => 'uri imagen del logo',
        'image_hero' => 'imagen de portada',
        'image_hero_uri' => 'uri imagen de portada',
        'image_logo_new' => 'imagen del logo nueva',
        'image_hero_new' => 'imagen de portada nueva',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////
    
    public function downloadQR(){
        $path = 'archives/images/' . $this->company->id . '/qrs/'. $this->image_qr;
        if(File::exists($path)){
            redirect()->route('dashboard.index');
            return response()->download(public_path($path));
        }else{
            session()->flash('messageError', 'Solicitar imagen QR a femaser');
        }

    }

    ///////////////////////////// MODULO CARGA DE DATOS /////////////////////////////

    // precargar datos a editar de la empresa
    public function mount(Company $company) {

        // verificar que el usuario pertenece a empresa
        $this->authorize('view', $company); 

        // datos para tags
        $this->company_data = $company;
        $this->socialMedia = SocialMedia::all();
        $this->loadSocialMediaData();

        // cargar propiedades 
        $this->name = $company['name'];
        $this->slug = $company['slug'];
        $this->email = $company['email'];
        $this->phone = $company['phone'];
        $this->adress = $company['adress'];
        $this->city = $company['city'];
        $this->social = $company['social'];
        $this->times_description = $company['times_description'];
        $this->short_description = $company['short_description'];
        $this->description = $company['description'];
        $this->type_menu = $company['type_menu'];
        $this->image_qr = $company['image_qr'];
        $this->image_qr_uri = $company['image_qr_uri'];
        $this->image_logo = $company['image_logo'];
        $this->image_logo_uri = $company['image_logo_uri'];
        $this->image_hero = $company['image_hero'];
        $this->image_hero_uri = $company['image_hero_uri'];
    }

    ///////////////////////////// MODULO MANY TO MANY /////////////////////////////

    // cargar datos de redes sociales de la empresa
    public function loadSocialMediaData(){
        foreach ($this->company_data->socialMedia as $social) {

            // llenar la variable socialMediaData[id] con cada id (facebook) y su url
            $this->socialMediaData[$social->id] = $social->pivot->url;
        }
    }

    // funcion para actualizar tags
    public function updateSocialMedia(){
        foreach ($this->socialMediaData as $socialMediaId => $url) {
            $this->company->socialMedia()->syncWithoutDetaching([$socialMediaId => ['url' => $url]]);
        }
    }

    ///////////////////////////// MODULO IMAGENES /////////////////////////////

    // eliminar imagen al reemplazarla
    public function deleteImage(){
        CrudInterventionImage::deleteImage(
            $this->image_hero, 
            auth()->user()->company->id . '/heros/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageEdit() {
        $this->deleteImage();
        $this->image_hero = '';
        $this->company->update(
            $this->only(['image_hero'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImage(){

        // crear o reemplazar imagen
        if($this->image_hero_new){
            $this->dataImage = CrudInterventionImage::uploadImage(
                $this->image_hero, 
                auth()->user()->company->id . '/heros/', 
                $this->image_hero_new
            );

            $this->image_hero = $this->dataImage[0];
        }
    }

    // rotar imagen
    public function rotateImage(){
        $imageRotated = CrudInterventionImage::rotateImage($this->image_hero, auth()->user()->company->id . '/heros/');
        $this->image_hero = $imageRotated[0];
        $this->company->update(
            $this->only(['image_hero'])
        );
    }

    // eliminar imagen al reemplazarla
    public function deleteImageLogo(){
        CrudInterventionImage::deleteImage(
            $this->image_logo, 
            auth()->user()->company->id . '/logos/'
        );
    }

    // eliminar solo imagen del producto en editar
    public function deleteImageLogoEdit() {
        $this->deleteImageLogo();
        $this->image_logo = '';
        $this->company->update(
            $this->only(['image_logo'])
        );
    }

    // subir imagen al crear producto o editar al reemplazar
    public function uploadImageLogo(){

        // crear o reemplazar imagen
        if($this->image_logo_new){
            $this->dataImageLogo = CrudInterventionImage::uploadImage(
                $this->image_logo, 
                auth()->user()->company->id . '/logos/', 
                $this->image_logo_new
            );

            $this->image_logo = $this->dataImageLogo[0];
        }
    }

    // rotar imagen
    public function rotateImageLogo(){
        $imageRotated = CrudInterventionImage::rotateImage($this->image_logo, auth()->user()->company->id . '/logos/');
        $this->image_logo = $imageRotated[0];
        $this->company->update(
            $this->only(['image_logo'])
        );
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // boton de guardar o editar
    public function save() {

        $this->slug = Str::slug($this->name);

        // validar datos
        $this->validate();

        // subir imagen de portada
        $this->uploadImage();
        if($this->dataImage){
            $this->image_hero_uri = $this->dataImage[1];
        }
        // subir imagen de portada
        $this->uploadImageLogo();
        if($this->dataImageLogo){
            $this->image_logo_uri = $this->dataImageLogo[1];
        }

        $this->company->update(
            $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'times_description', 'short_description', 'description', 'type_menu', 'image_logo', 'image_logo_uri', 'image_hero', 'image_hero_uri'])
        );

        $this->updateSocialMedia();

        return redirect()->route('dashboard.index');
        session()->flash('messageSuccess', 'Actualizado');
    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        return view('livewire.page.config-index');
    }
}
