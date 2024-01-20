<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Page\Company;
use App\Models\Page\SocialMedia;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ConfigIndex extends Component
{
    // subir imagen
    use WithFileUploads;

    // propiedades del form
    public $name;
    public $slug;
    public $email;
    public $phone;
    public $adress;
    public $city;
    public $social;
    public $description;
    public $image_logo;
    public $image_hero;

    public $image_logo_new;
    public $image_hero_new;
    
    // propiedades para editar
    public $company;
    
    public $company_data;
    public $socialMedia;
    public $socialMediaData = [];

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:4'],
            'slug' => ['required', 'string', 'min:4'],
            'email' => ['required', 'email', 'min:4'],
            'phone' => ['nullable', 'numeric', 'min:4'],
            'adress' => ['nullable', 'string', 'min:4'],
            'city' => ['nullable', 'string', 'min:4'],
            'social' => ['nullable', 'string', 'min:4'],
            'description' => ['nullable', 'string', 'min:4'],
            'image_logo' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'image_logo_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:3096'],
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
        'image_logo_new' => 'imagen del logo nueva',
        'image_hero_new' => 'imagen de portada nueva',
    ];

    // precargar datos a editar de la empresa
    public function mount(Company $company) {

        $this->company_data = $company;
        $this->socialMedia = SocialMedia::all();
        $this->loadSocialMediaData();

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
    }

    // cargar datos de redes sociales de la empresa
    public function loadSocialMediaData()
    {
        foreach ($this->company_data->socialMedia as $social) {
            // llenar la variable socialMediaData[id] con cada id (facebook) y su url
            $this->socialMediaData[$social->id] = $social->pivot->url;
        }
    }

    public function updateSocialMedia()
    {
        foreach ($this->socialMediaData as $socialMediaId => $url) {
            $this->company->socialMedia()->syncWithoutDetaching([$socialMediaId => ['url' => $url]]);
        }
    }

    // eliminar imagen de portada
    public function deleteImage(){
        if($this->image_hero != ''){
            // $path = public_path('archives/images/hero/'.$this->image_hero);
            $path = 'archives/images/hero/'.$this->image_hero;
            // if(file_exists($path)){
            //     unlink($path);
            // }
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

    // eliminar imagen del logo
    public function deleteImageLogo(){
        if($this->image_logo != ''){
            $path = public_path('archives/images/logo/'.$this->image_logo);
            if(File::exists($path)){
                unlink($path);
            }
        }
    }
    public function deleteImageLogoEdit() {
        $this->deleteImageLogo();
        $this->image_logo = '';
        $this->company->update(
            $this->only(['image_logo'])
        );
    }

    // subir imagen de portada a la empresa
    public function uploadImage(){
    
        // Verificar si la carpeta existe, si no, crearla

        // $path = public_path('archives/images/hero');
        
        // if (!storage::directoryExists($path)) {
        //     Storage::createDirectory($path);
        // }
        // if (!file_exists($path) && is_dir($path)) {
        //     chmod($path, 777);
        //     mkdir($path, 777, true);
        // }

        // crear o reemplazar imagen
        if($this->image_hero_new){
            // $this->deleteImage();
            $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id.'.jpg';
            // $image_hero = Image::make($this->image_hero_new);
            // $image_hero->resize(600, null, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $image_hero->save(public_path('archives/images/hero/'.$name));
            // $this->image_hero = $name;
            $this->image_hero_new->store('archives/img/hero/'.$name);
        }
    }

    // subir logo a la empresa
    public function uploadImageLogo(){
    
        // Verificar si la carpeta existe, si no, crearla

        // $path = public_path('archives/images/logo/');
        // if (!storage::directoryExists($path)) {
        //     Storage::createDirectory($path);
        // }

        // crear o reemplazar imagen
        if($this->image_logo_new){
            $this->deleteImageLogo();
            $name = time().'_'.auth()->user()->id.'_'.auth()->user()->company_id.'.jpg';
            $image_logo = Image::make($this->image_logo_new);
            $image_logo->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_logo->save(public_path('archives/images/logo/'.$name));
            $this->image_logo = $name;
        }
    }

    // boton de guardar o editar
    public function save() {
        $this->slug = Str::slug($this->name);

        $this->validate();
        
        $this->uploadImage();
        $this->uploadImageLogo();

        $this->company->update(
            $this->only(['name', 'slug', 'email', 'phone', 'adress', 'city', 'social', 'description', 'image_logo', 'image_hero'])
        );

        $this->updateSocialMedia();

        return redirect()->route('dashboard.index');
        session()->flash('messageSuccess', 'Actualizado');
    }

    public function render()
    {
        return view('livewire.page.config-index');
    }
}
