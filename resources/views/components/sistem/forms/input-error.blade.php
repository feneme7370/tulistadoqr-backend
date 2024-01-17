@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 mb-2']) }}>{{ $message }}</p>
@enderror
