@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center justify-center px-4 py-2 gap-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple focus:ring focus:ring-purple-950 focus:ring-offset-2']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>