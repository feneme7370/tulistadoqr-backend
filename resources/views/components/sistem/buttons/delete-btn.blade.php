@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1 

p-1 text-sm font-medium leading-5 rounded-lg
text-white 
bg-red-600

transition-colors duration-150

border border-transparent 

active:bg-red-600 

hover:bg-red-700 

focus:outline-none 
focus:shadow-outline-red 
focus:ring focus:ring-red-950 
focus:ring-offset-2

']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>