@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1
px-2 py-1 text-sm font-medium text-white rounded-lg

transition-colors duration-150 

bg-red-700 

border border-transparent  

active:bg-red-500 

hover:bg-red-500 

focus:border-red-300 
focus:outline-none  
focus:shadow-outline-red 
focus:ring 
focus:ring-red-700 
focus:ring-offset-0

']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>