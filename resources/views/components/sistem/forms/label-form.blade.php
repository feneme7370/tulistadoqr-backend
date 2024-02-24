@props(['value' => ''])

<label {{ $attributes->merge(['class' => '
block 
mt-1
text-sm text-gray-700
']) }}>
    {{ $value }}
</label>
