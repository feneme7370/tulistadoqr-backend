<div class="px-4 py-3 mb-8 flex justify-between items-center flex-col md:flex-row bg-white rounded-lg shadow-md">
    <div class="w-full">
        <x-sistem.forms.input-form 
            wire:model.debounce.1000ms="search" 
            type="search" 
            placeholder="Search" 
            class="w-full" />
    </div>
    
    <div class="mr-2 flex gap-2 items-center md:justify-end w-full text-gray-900">
        <x-sistem.forms.label-form value="Destacados">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="suggested" />
        </x-sistem.forms.label-form>
    </div>

    <div class="mr-2 flex gap-2 items-center md:justify-end w-full text-gray-900">
        <x-sistem.forms.label-form value="Activos">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="active" />
        </x-sistem.forms.label-form>
    </div>
</div>