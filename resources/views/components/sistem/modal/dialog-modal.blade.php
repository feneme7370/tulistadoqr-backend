@props(['id' => null, 'maxWidth' => null])

<div>
    <x-sistem.modal.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
        <div class="px-6 py-4 dark:bg-gray-400">
            <div class="text-lg font-medium text-gray-900 ">
                {{ $title }}
            </div>
    
            <div class="mt-2 text-sm text-gray-600 dark:text-gray-800">
                {{ $content }}
            </div>
        </div>
    
        <div class="flex flex-row justify-end px-6 py-4 gap-2 bg-gray-100 dark:bg-gray-500 text-end">
            {{ $footer }}
        </div>
    </x-sistem.modal.modal>
</div>
