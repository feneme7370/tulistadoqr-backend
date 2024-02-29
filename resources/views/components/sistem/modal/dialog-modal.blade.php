@props(['id' => null, 'maxWidth' => null])

<div>
    <x-sistem.modal.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
        <div class="px-6 py-4">
            <div class="font-bold uppercase text-xl text-gray-900 text-center">
                {{ $title }}
            </div>
    
            <div class="mt-2 text-sm text-gray-600">
                {{ $content }}
            </div>
        </div>
    
        <div class="flex flex-row justify-end px-6 py-4 gap-2 bg-gray-100 text-end">
            {{ $footer }}
        </div>
    </x-sistem.modal.modal>
</div>
