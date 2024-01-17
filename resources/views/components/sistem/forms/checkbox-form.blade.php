@props(['disabled' => false])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none  focus:shadow-outline-purple dark:focus:shadow-outline-gray rounded

focus:ring focus:ring-purple-950 focus:ring-offset-2
']) !!}>
