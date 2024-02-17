@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center justify-center gap-1
px-2 py-1 text-sm font-medium text-white rounded-lg

transition-colors duration-150 

bg-primary-700 

border border-transparent  

active:bg-primary-800 

hover:bg-primary-800 

focus:border-primary-300 
focus:outline-none  
focus:shadow-outline-primary 
focus:ring 
focus:ring-primary-700 
focus:ring-offset-0

']) }}>
    {{$icon}}
    <span>{{ $slot }}{{ $title }}</span>
</button>