@props(['title' => ''])


<div class="flex justify-center items-center w-full my-1"
{{ $attributes->merge(['type' => 'button', 'class' => '']) }}>

    <div class="flex justify-center items-center gap-4">

        <div
        class="inline-block h-2 w-2 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
        role="status"></div>

    </div>
    

</div>