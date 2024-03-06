<?php

namespace App\Livewire\Page;

use App\Models\Page\Company;
use Livewire\Component;

class InformationIndex extends Component
{
    public function render()
    {
        $femaser = Company::where('id', 1)->first();
        $femaserWsp = 5492396513953;
        return view('livewire.page.information-index', compact('femaser', 'femaserWsp'));
    }
}
