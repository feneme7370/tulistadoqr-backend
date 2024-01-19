<div class="p-2 mb-1 flex justify-between items-center flex-col md:flex-row bg-white rounded-lg shadow-md gap-1 dark:bg-gray-800">
    <div class="w-full">
        <x-sistem.forms.input-form 
            wire:model.live="search" 
            type="search" 
            placeholder="Buscar" 
            class="w-full" />
    </div>
    <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full">
        <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="active" />Activos
    </div>
</div>