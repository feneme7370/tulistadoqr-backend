@props(['title' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center gap-2 p-2 font-semibold text-xs text-indigo-400 uppercase tracking-widest hover:text-indigo-500 active:text-indigo-700']) }}>
    <div class="flex flex-row gap-1 items-center">
        
        <x-sistem.icons.hi-pencil-square/>
        {{ $title }}{{$slot}}
    </div>
</button>
