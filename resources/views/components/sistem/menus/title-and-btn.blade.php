@props(['title'])

<div class="px-4 py-3 mb-8 flex flex-col md:flex-row justify-between items-center bg-white rounded-lg shadow-md dark:bg-gray-800 gap-5">
    <p class="text-2xl text-gray-600 dark:text-gray-400">
        {{$title}}
    </p>
    {{$slot}}
</div>