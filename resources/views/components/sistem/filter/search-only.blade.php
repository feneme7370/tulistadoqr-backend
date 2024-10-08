@props([
    'placeholder_box_1' => 'Buscar',
    'property_box_1' => 'search'
])

<div class="p-2 mb-1 flex justify-between items-center flex-col md:flex-row bg-gray-50 rounded-lg shadow-md gap-1 ">
    <div class="w-full">
        <x-sistem.forms.input-form 
            wire:model.live="{{ $property_box_1 }}" 
            type="search" 
            placeholder="{{ $placeholder_box_1 }}" 
            class="w-full" />
    </div>
</div>