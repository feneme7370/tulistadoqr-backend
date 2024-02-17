@props(['active', 'title'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white bg-primary-300 dark:hover:bg-gray-700 dark:bg-gray-900 group'
            : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-primary-200 dark:hover:bg-gray-700 group';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{$slot}}
        <span class="ms-3">{{$title}}</span>
    </a>
</li>
