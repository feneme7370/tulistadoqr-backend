@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '

block w-full 
text-sm form-input text-gray-900  bg-white rounded-lg shadow-md
my-1 p-2 

focus:border-primary-400 
focus:outline-none  
focus:shadow-outline-primary 
focus:ring 
focus:ring-primary-950 
focus:ring-offset-0
']) !!}>