@props(['title' => false, 'messageErrorInput' => false])

@if(session()->has('messageErrorInput'))
<div class="bg-red-100 border border-red-400 text-red-700 text-sm px-4 py-3 rounded" role="alert">
    <strong class="font-bold">{{$title}}</strong>
    <span class="block sm:inline">{{$messageErrorInput}}</span>
</div>
@endif