@props(['title' => ''])

<div {{ $attributes->merge(['class' => '
    text-sm text-gray-700 mb-3
']) }}>       

        {{ $title }}{{$slot}}

</div>
