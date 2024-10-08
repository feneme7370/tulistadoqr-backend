@props(['placeholder' => 'Buscar', 'title' => 'Activos'])

<div class="p-2 mb-1 flex justify-between items-center flex-col md:flex-row bg-gray-50 rounded-lg shadow-md gap-1 ">
    <div class="w-full">
        <x-sistem.forms.input-form 
            wire:model.live.debounce.600ms="search" 
            type="search" 
            placeholder="{{$placeholder}}" 
            class="w-full" />
    </div>
    <div class="mr-2 flex gap-2 justify-center items-center md:justify-end w-full text-gray-900">
        <x-sistem.forms.label-form value="{{ $title }}">
            <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="active" />
        </x-sistem.forms.label-form>
    </div>
</div>