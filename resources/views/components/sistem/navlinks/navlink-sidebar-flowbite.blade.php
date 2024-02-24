@props(['active', 'title'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-gray-900 rounded-lg bg-primary-300 group'
            : 'flex items-center p-2 text-gray-900 rounded-lg hover:bg-primary-200  group';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{$slot}}
        <span class="ms-3">{{$title}}</span>
    </a>
</li>
