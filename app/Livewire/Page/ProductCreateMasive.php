<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Level;
use Illuminate\Support\Str;
use App\Models\Page\Product;
use App\Models\Page\Category;
use Livewire\WithFileUploads;

class ProductCreateMasive extends Component
{
    ///////////////////////////// MODULO SUBIR ARCHIVOS /////////////////////////////
    // subir archivos en livewire
    use WithFileUploads;

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades para el modal
    public $name;
    public $slug;
    public $description;
    public $price_original;
    public $status;
    public $category_id;
    public $user_id;
    public $company_id;


       // reglas de validacion
       public function rules(){
        return [
            'name' => ['required', 'string', 'min:3'],
            'slug' => ['required', 'string', 'min:3'],
            'price_original' => ['required', 'numeric', 'min:1'],
            // 'price_seller' => ['nullable', 'numeric', 'min:0'],
            // 'cost' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'price_original' => 'precio original',
        // 'price_seller' => 'precio de oferta',
        // 'cost' => 'costo',
        'description' => 'descripcion',
        'category_id' => 'categoria',
        'user_id' => 'usuario',
        'company_id' => 'empresa',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // contar elementos de membresia
    public function countProducts() {
        $amount = count(Product::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->product;

        if($amount >= $membershipNumber){
            $this->dispatch('toastrError', 'Excede la cantidad permitida de '.$membershipNumber.' productos');
            return true;
        }
    }
    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'description', 'user_id', 'company_id']);
    }

    // boton de guardar o editar
    public function save() {

        // validar form

            $this->status = '1';
            $this->slug = Str::slug($this->name);
            $this->category_id = $this->category_id;
            $this->user_id = auth()->user()->id;
            $this->company_id = auth()->user()->company->id;

            $this->validate();
    
            Product::create([   
                'name' => $this->name,
                'slug' => $this->slug,
                'price_original' => $this->price_original,
                'description' => $this->description,
                'status' => $this->status,
                'category_id' => $this->category_id,
                'user_id' => $this->user_id,
                'company_id' => $this->company_id,
            ]);


        $this->resetProperties();

        $this->dispatch('toastrSuccess', 'Guardado con exito');

    }

    public function render()
    {
        $levels = Level::where('company_id', auth()->user()->company_id)->get();
        $categories = Category::with('level')
                        ->where('company_id', auth()->user()->company_id)
                        ->orderBy('level_id', 'DESC')->get();
        return view('livewire.page.product-create-masive', compact(
            'levels',
            'categories',
        ));
    }
}
