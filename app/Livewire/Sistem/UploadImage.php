<?php

namespace App\Livewire\Sistem;

use Livewire\Component;
use Livewire\Attributes\On;

use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\File;

class UploadImage extends Component
{

    // eliminar imagen al reemplazarla
    #[On('delete-image-component')] 
    public function deleteImageComponent(){
        // if($imageString != ''){
        //     $path = $pathFolder.$imageString;
        //     if(File::exists($path)){
        //         File::delete($path);
        //     }
        // }
        return redirect()->route('dashboard.index');
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            <!-- el componente -->
        </div>
        HTML;
    }
}
