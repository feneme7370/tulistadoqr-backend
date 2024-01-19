@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1
px-2 py-1 text-sm font-medium text-white rounded-lg

transition-colors duration-150 

bg-purple-600 

border border-transparent  

active:bg-purple-600 

hover:bg-purple-700 

focus:border-purple-400 
focus:outline-none  
focus:shadow-outline-purple 
focus:ring 
focus:ring-purple-950 
focus:ring-offset-0

']) }}>
    {{$icon}}
    <span>{{ $title }}</span>
</button>