@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center justify-center px-4 py-2 gap-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray focus:ring focus:ring-gray-950 focus:ring-offset-2']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>