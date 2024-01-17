@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center justify-center px-4 py-2 gap-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red focus:ring focus:ring-red-950 focus:ring-offset-2']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>