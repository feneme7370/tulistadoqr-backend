<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Page\Product;
use Livewire\WithPagination;
use App\Models\Page\Suggestion;

class SuggestionIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    
    // propiedades de busqueda
    public $perPage = 10;

    ///////////////////////////// MODULO PROPIEDADES /////////////////////////////

    // propiedades del form
    public $product_id;
    public $user_id;
    public $company_id;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

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

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

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

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['product_id', 'user_id', 'company_id']);
    }

    ///////////////////////////// MODULO CRUD /////////////////////////////

    // eliminar desde el modal de confirmacion
    public function deleteSuggestion($id) {
        $this->resetProperties();
        
        $suggestion = Suggestion::findOrFail($id);
        $this->authorize('delete', $suggestion);

        $suggestion->delete();

        $this->resetProperties();
        
        $this->dispatch('toastrSuccess', 'Eliminado con exito');
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

        $this->resetProperties();
        $this->dispatch('toastrSuccess', 'Guardado con exito');

    }

    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $products = Product::where('company_id', auth()->user()->company_id)
                        ->orderBy('name', 'ASC')->get();

        $suggestions = Suggestion::with('product', 'company')
                        ->where('company_id', auth()->user()->company_id)
                        ->paginate($this->perPage, pageName: 'p_suggestion');
        
        return view('livewire.page.suggestion-index', compact('suggestions', 'products'));
    }
}
