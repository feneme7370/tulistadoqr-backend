@props(['title' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center gap-2 p-2 font-semibold text-xs text-red-400 uppercase tracking-widest hover:text-red-500 active:text-red-700']) }}>

        <x-sistem.icons.hi-trash/>
          
        {{$slot}}{{ $title }}

</button>
