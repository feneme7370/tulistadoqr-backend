@props([
    'placeholder_box_1' => '',
    'property_box_1' => '',
    'placeholder_box_2' => '',
    'property_box_2' => '',
    'placeholder_box_3' => '',
    'property_box_3' => '',
    'placeholder_box_4' => '',
    'property_box_4' => '',
    'placeholder_box_5' => '',
    'property_box_5' => '',
    'placeholder_box_6' => '',
    'property_box_6' => '',
     ])

@if ($placeholder_box_1)
    
<div class="p-2 mb-1 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-1 bg-gray-50 rounded-lg shadow-md ">
    @if ($placeholder_box_1)
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-start w-full text-gray-900">
            <x-sistem.forms.label-form value="{{ $placeholder_box_1 }}">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_1 }}" />
            </x-sistem.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_2)
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-start w-full text-gray-900">
            <x-sistem.forms.label-form value="{{ $placeholder_box_2 }}">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_2 }}" />
            </x-sistem.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_3)
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-start w-full text-gray-900">
            <x-sistem.forms.label-form value="{{ $placeholder_box_3 }}">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_3 }}" />
            </x-sistem.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_4)
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-start w-full text-gray-900">
            <x-sistem.forms.label-form value="{{ $placeholder_box_4 }}">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_4 }}" />
            </x-sistem.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_5)
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-start w-full text-gray-900">
            <x-sistem.forms.label-form value="{{ $placeholder_box_5 }}">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_5 }}" />
            </x-sistem.forms.label-form>
        </div>
    @endif
    @if ($placeholder_box_6)
        <div class="mr-2 flex gap-2 justify-center items-center md:justify-start w-full text-gray-900">
            <x-sistem.forms.label-form value="{{ $placeholder_box_6 }}">
                <x-sistem.forms.checkbox-form type="checkbox" class="" wire:model.live="{{ $property_box_6 }}" />
            </x-sistem.forms.label-form>
        </div>
    @endif
    
</div>
@endif