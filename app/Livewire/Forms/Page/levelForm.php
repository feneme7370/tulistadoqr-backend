<?php

namespace App\Livewire\Forms\Page;

use Livewire\Form;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class levelForm extends Form
{
    // crear variable del objeto
    public ?Level $level;

    // propiedades del form
    public $name;
    public $slug;
    public $description;
    public $status;
    public $image_hero;
    public $image_hero_uri;
    public $image_hero_new;
    public $user_id;
    public $company_id;

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['numeric'],
            'image_hero_uri' => ['nullable', 'string'],
            'image_hero' => ['nullable', 'string'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],

            'image_hero_new' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'description' => 'descripcion',
        'status' => 'estado',
        'image_hero_uri' => 'uri imagen de portada',
        'image_hero' => 'imagen de portada',
        'user_id' => 'usuario',
        'company_id' => 'empresa',

        'image_hero_new' => 'archivo de imagen',
    ];

    public function store(){
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar datos
        $this->validate();

        // crear datos
        Level::create(
            $this->only(['name', 'slug', 'description', 'image_hero', 'image_hero_uri', 'status', 'user_id', 'company_id'])
        );
    }

    public function update(){
        // poner datos automaticos
        $this->status = $this->status ? '1' : '0';
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar datos
        $this->validate();

        // editar datos
        $this->level->update(
            $this->only(['name', 'slug', 'description', 'image_hero', 'image_hero_uri', 'status', 'user_id', 'company_id'])
        );
    }
}
