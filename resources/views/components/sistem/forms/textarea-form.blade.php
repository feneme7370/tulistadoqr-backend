@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
resize-none 
block w-full 
text-sm form-input text-gray-900  bg-white rounded-lg shadow-md
my-1 p-2 

focus:outline-none 
focus:shadow-outline-primary
focus:border-primary-400
focus:ring 
focus:ring-primary-950 
focus:ring-offset-0
']) !!}  rows="4"></textarea>
