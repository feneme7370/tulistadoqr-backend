@props(['title'])

<div class="
    p-2 mb-1 flex flex-row justify-between items-center rounded-lg shadow-md gap-1
    
    bg-primary-100 dark:bg-gray-800
    border border-primary-300 dark:border-gray-900
">
    <p class="text-lg font-bold sm:text-2xl text-gray-600 dark:text-gray-400">
        {{$title}}
    </p>
    {{$slot}}
</div>