@props(['value' => ''])

<label {{ $attributes->merge(['class' => '
flex flex-row gap-2 items-center justify-start
mt-1
text-sm text-gray-700
']) }}>
    {{ $slot }}{{ $value }}
</label>
