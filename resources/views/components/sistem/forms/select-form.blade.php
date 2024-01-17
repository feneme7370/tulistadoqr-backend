@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray

focus:ring focus:ring-purple-950 focus:ring-offset-2  text-gray-900

px-4 py-3 mb-1 bg-white rounded-lg shadow-md dark:bg-gray-800']) !!}>
    <option value="">-- Seleccionar --</option>
    {{ $slot }}
</select>