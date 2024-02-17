@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '
block w-full text-center
text-sm form-input text-gray-900  bg-white rounded-lg shadow-md
my-1 p-2 

dark:border-gray-600
dark:focus:shadow-outline-gray
dark:text-gray-300
dark:bg-gray-700

focus:outline-none 
focus:shadow-outline-primary
focus:border-primary-400
focus:ring 
focus:ring-primary-950 
focus:ring-offset-0
']) !!}>
    <option value="">-- Seleccionar --</option>
    {{ $slot }}
</select>