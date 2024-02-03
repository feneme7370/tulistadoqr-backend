@props(['title'])

<div class="p-2 mb-1 flex flex-row justify-between items-center bg-purple-100 border border-purple-300 rounded-lg shadow-md dark:bg-gray-800 gap-1">
    <p class="text-lg font-bold sm:text-2xl text-gray-600 dark:text-gray-400">
        {{$title}}
    </p>
    {{$slot}}
</div>