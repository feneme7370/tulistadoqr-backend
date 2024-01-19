@props(['disabled' => false])

<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
text-purple-600 form-checkbox 
rounded

dark:focus:shadow-outline-gray

focus:border-purple-400 
focus:outline-none  
focus:shadow-outline-purple 
focus:ring 
focus:ring-purple-950 
focus:ring-offset-0
']) !!}>
