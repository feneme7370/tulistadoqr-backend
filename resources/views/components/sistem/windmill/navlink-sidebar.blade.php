@props(['active', 'title'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800'
            : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{$slot}}{{$title}}
</a>

<li class="relative px-6 py-3">
    @if ($active)
    <span
      class="absolute inset-y-0 left-0 w-1 bg-primary-600 rounded-tr-lg rounded-br-lg"
      aria-hidden="true"
    ></span>
    @endif
    <a
        {{ $attributes->merge(['class' => $classes]) }}
    >
    {{$slot}}
      <span class="ml-4">{{$title}}</span>
    </a>
</li>
