@props(['title' => '', 'icon' => ''])

<button {{ $attributes->merge(['type' => 'button', 'class' => '

    flex items-center justify-center gap-1

    text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-600 font-medium rounded-lg text-sm px-2 py-1 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800

    ']) }}
    wire:loading.class="opacity-50"
    wire:loading.attr="disabled"
>
    {{$icon}}
    <span>{{ $slot }}{{ $title }}</span>
</button>