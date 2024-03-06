@props(['placeholder' => 'Buscar'])

<div {{ $attributes->merge(['class' => 'mb-1 flex flex-row flex-1 justify-evenly items-center gap-2 p-2 bg-gray-50 rounded-lg shadow-md']) }}>
    {{$slot}}
</div>