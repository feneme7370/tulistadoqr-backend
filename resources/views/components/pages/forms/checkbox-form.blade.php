@props(['type' => 'checkbox', 'placeholder' => 'Buscar','disabled' => false])

<input type="{{ $type }}" placeholder="{{ $placeholder }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
w-4 h-4 

bg-gray-50 border border-gray-300 sm:text-sm rounded-md 
text-yellow-800

focus:ring-yellow-600 
focus:border-yellow-600 

dark:bg-gray-700 
dark:border-gray-600 
dark:placeholder-gray-400 
dark:text-white 
dark:focus:ring-yellow-600 
dark:focus:border-yellow-600

 dark:ring-offset-gray-800
']) !!}>