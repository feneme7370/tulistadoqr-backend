@props(['title' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

flex items-center gap-2 p-1 font-semibold text-xs 

uppercase tracking-widest
text-red-400 

hover:text-red-500 

active:text-red-700
']) }}>

        <x-sistem.icons.hi-trash/>
          
        {{$slot}}{{ $title }}

</button>
