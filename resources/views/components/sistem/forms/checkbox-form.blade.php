@props(['disabled' => false])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
 form-checkbox 
rounded

text-primary-600

focus:border-primary-400 
focus:outline-none  
focus:shadow-outline-primary
focus:ring 
focus:ring-primary-950 
focus:ring-offset-0
']) !!}>
