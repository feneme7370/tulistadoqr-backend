<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Suggestion;

class SuggestionIndex extends Component
{
    // paginacion
    use WithPagination;
    
    // propiedades del form
    public $product_id;
    public $user_id;
    public $company_id;

    // reglas de validacion
    public function rules(){
        return [
            'product_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'product_id' => 'producto',
        'user_id' => 'usuario',
        'company_id' => 'empresa',
    ];

    // contar elementos de membresia
    public function countSuggestion() {
        $amount = count(Suggestion::where('company_id', auth()->user()->company_id)->get());
        $membershipNumber = auth()->user()->company->membership->suggestion;
        if($amount >= $membershipNumber){
            session()->flash('messageError', 'Excede la cantidad permitida');
            return true;
        }
    }

    // comprobar que ya exista
    public function existSuggestion() {
        $suggestionCreated = Suggestion::where('company_id', auth()->user()->company_id)
                                ->where('product_id', $this->product_id)->get();
        if(count($suggestionCreated) != 0){
            session()->flash('messageError', 'Ya existe como destacado');
            return true;
        }
    }

    // eliminar desde el modal de confirmacion
    public function deleteSuggestion($id) {
        $suggestion = Suggestion::findOrFail($id);
        $suggestion->delete();
        session()->flash('messageSuccess', 'Registro eliminado');
        $this->reset();
    }

    // boton de guardar o editar
    public function save() {

        // comprobar si existe y la cantidad
        if($this->countSuggestion()){return;}
        if($this->existSuggestion()){return;}

        // crear datos necesarios
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company_id;

        // validar form
        $this->validate();
        
        // crear o editar segun id
        Suggestion::create(
            $this->only(['product_id', 'user_id', 'company_id'])
        );

        $this->reset();
        session()->flash('messageSuccess', 'Guardado');

    }

    public function render()
    {
        $products = Product::where('company_id', auth()->user()->company_id)
                        ->orderBy('name', 'ASC')->get();

        $suggesteds = Suggestion::where('company_id', auth()->user()->company_id)
        ->paginate(10);
        
        return view('livewire.page.suggestion-index', compact('suggesteds', 'products'));
    }
}
