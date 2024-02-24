@props(['title'])

<div class="
    p-2 mb-1 flex flex-row justify-between items-center rounded-lg shadow-md gap-1
    
    bg-primary-100 
    border border-primary-300 
">
    <p class="text-lg font-bold sm:text-2xl text-gray-600">
        {{$title}}
    </p>
    {{$slot}}
</div>