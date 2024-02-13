<?php

namespace App\Livewire\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Page\SocialMedia;

class SocialMediaIndex extends Component
{
    ///////////////////////////// MODULO PAGINACION /////////////////////////////

    // paginacion
    use WithPagination;
    public function updatingActive() {$this->resetPage(pageName: 'p_social_media');}
    public function updatingSearch() {$this->resetPage(pageName: 'p_social_media');}

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
    public $user_id;
    public $company_id;

    // propiedades para editar
    public $social_media;

    ///////////////////////////// MODULO VALIDACION /////////////////////////////

    // reglas de validacion
    public function rules(){
        return [
            'name' => ['required', 'string', 'min:2'],
            'slug' => ['required', 'string'],
            'user_id' => ['required', 'numeric'],
            'company_id' => ['required', 'numeric'],
        ];
    }

    // renombrar variables a castellano
    protected $validationAttributes = [
        'name' => 'nombre',
        'slug' => 'slug',
        'user_id' => 'usuario',
        'company_id' => 'empresa',
    ];

    ///////////////////////////// MODULO UTILIDADES /////////////////////////////

    // resetear variables
    public function resetProperties() {
        $this->resetErrorBag();
        $this->reset(['name', 'slug', 'user_id', 'company_id']);
    }

    ///////////////////////////// MODULO CRUD CON MODALES /////////////////////////////

    // abrir modal y recibir id
    public function openDeleteModal($id){
        $this->resetProperties();

        $this->social_media = SocialMedia::findOrFail($id);
        $this->authorize('delete', $this->social_media); 

        $this->showDeleteModal = true;
    }
    
    // eliminar desde el modal de confirmacion
    public function deleteSocialMedia() {
        $this->resetProperties();

        $social_media = SocialMedia::findOrFail($this->social_media->id);

        $social_media->delete();
        session()->flash('messageSuccess', 'Registro eliminado');

        $this->resetProperties();
        $this->reset('social_media');

        $this->showDeleteModal = false;
    }

    // mostrar modal para confirmar crear
    public function createActionModal() {
        $this->reset(['social_media']);
        $this->resetProperties();

        $this->showActionModal = true;
    }

    // // mostrar modal para confirmar editar
    public function editActionModal(SocialMedia $social_media) {
        $this->resetProperties();

        $this->social_media = $social_media;
        $this->authorize('update', $this->social_media); 

        $this->name = $social_media['name'];
        $this->slug = $social_media['slug'];
        $this->user_id = $social_media['user_id'];
        $this->company_id = $social_media['company_id'];

        $this->showActionModal = true;
    }

    // boton de guardar o editar
    public function save() {
    
        // poner datos automaticos
        $this->slug = Str::slug($this->name);
        $this->user_id = auth()->user()->id;
        $this->company_id = auth()->user()->company->id;

        // validar datos
        $this->validate();
        
        if( isset( $this->social_media['id'])) {

            // editar datos
            $this->social_media->update(
                $this->only(['name', 'slug', 'user_id', 'company_id'])
            );

            $this->reset(['social_media']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Actualizado');

        } else {

            // crear datos
            SocialMedia::create(
                $this->only(['name', 'slug', 'user_id', 'company_id'])
            );

            $this->reset(['social_media']);
            $this->resetProperties();
            session()->flash('messageSuccess', 'Guardado');
        }

        $this->showActionModal = false;
    }
    
    ///////////////////////////// MODULO RENDER /////////////////////////////

    // renderizar vista
    public function render()
    {
        $social_medias = SocialMedia::where('company_id', auth()->user()->company_id)
                        ->when( $this->search, function($query) {
                            return $query->where(function( $query) {
                                $query->where('name', 'like', '%'.$this->search . '%');
                            });
                        })
                        ->orderBy( $this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
                        ->paginate($this->perPage, pageName: 'p_social_media');
                        
        return view('livewire.page.social-media-index', compact('social_medias'));
    }
}
