<div class="px-4 py-3 mb-8 flex justify-between items-center flex-col md:flex-row bg-white rounded-lg shadow-md dark:bg-gray-800">
    <div class="w-full">
        <x-sistem.forms.input-form 
            wire:model.debounce.1000ms="search" 
            type="search" 
            placeholder="Search" 
            class="w-full" />
    </div>
    
    <div class="mr-2 flex gap-2 items-center md:justify-end w-full">
        <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model="suggested" />Destacados
    </div>

    <div class="mr-2 flex gap-2 items-center md:justify-end w-full">
        <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model="active" />Activos
    </div>
</div>