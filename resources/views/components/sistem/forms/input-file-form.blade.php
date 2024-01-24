@props(['disabled' => false, 'description' => false])

<div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '

    block w-full 
    text-sm form-input text-gray-900  bg-white rounded-lg shadow-md
    my-1 p-2 
    cursor-pointer
    border border-gray-300
    bg-gray-50

    dark:border-gray-600
    dark:focus:shadow-outline-gray
    dark:text-gray-300
    dark:bg-gray-700

    dark:placeholder-gray-400
    focus:border-purple-400 
    focus:outline-none  
    focus:shadow-outline-purple 
    focus:ring 
    focus:ring-purple-950 
    focus:ring-offset-0
    ']) !!}>

    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{$description}}</p>

</div>