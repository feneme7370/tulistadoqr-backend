@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1
px-2 py-1 text-sm font-medium text-white rounded-lg

transition-colors duration-150 

bg-purple-700 

border border-transparent  

active:bg-purple-800 

hover:bg-purple-800 

focus:border-purple-300 
focus:outline-none  
focus:shadow-outline-purple 
focus:ring 
focus:ring-purple-700 
focus:ring-offset-0

']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>