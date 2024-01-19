@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1
px-2 py-1 text-sm font-medium text-white rounded-lg

transition-colors duration-150 

bg-gray-600 

border border-transparent  

active:bg-gray-600 

hover:bg-gray-700 

focus:border-gray-400 
focus:outline-none  
focus:shadow-outline-gray 
focus:ring 
focus:ring-gray-950 
focus:ring-offset-0
']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>