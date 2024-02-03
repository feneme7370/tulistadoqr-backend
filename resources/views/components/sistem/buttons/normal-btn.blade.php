@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1
px-2 py-1 text-sm font-medium text-white rounded-lg

transition-colors duration-150 

bg-gray-700 

border border-transparent  

active:bg-gray-800 

hover:bg-gray-800 

focus:border-gray-300 
focus:outline-none  
focus:shadow-outline-gray 
focus:ring 
focus:ring-gray-700 
focus:ring-offset-0
']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>