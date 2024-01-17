@props(['value' => ''])

<label {{ $attributes->merge(['class' => 'block mt-2 text-sm text-gray-700 dark:text-gray-400']) }}>
    {{ $value }}
</label>
