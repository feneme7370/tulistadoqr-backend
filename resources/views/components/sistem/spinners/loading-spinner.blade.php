@props(['title' => 'Cargando...'])


<div class="flex justify-between items-center gap-4"
{{ $attributes->merge(['type' => 'button', 'class' => '']) }}>

    <strong>{{$title}}</strong>
    
    <div
    class="ml-auto inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
    role="status"></div>

</div>