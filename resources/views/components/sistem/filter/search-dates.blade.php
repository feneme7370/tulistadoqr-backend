@props(['placeholder_start' => 'fecha inicial', 'placeholder_finish' => 'fecha final'])

<div class="p-2 mb-1 grid grid-cols-2 items-center flex-col md:flex-row bg-gray-50 rounded-lg shadow-md gap-1 ">
    <div class="w-full">
        <x-sistem.forms.input-date-form 
            wire:model.live.debounce.600ms="date_start" 
            type="date" 
            placeholder="{{$placeholder_start}}" 
            class="w-full" />
    </div>
    <div class="w-full">
        <x-sistem.forms.input-date-form 
            wire:model.live.debounce.600ms="date_finish" 
            type="date" 
            placeholder="{{$placeholder_finish}}" 
            class="w-full" />
    </div>

</div>