@props(['title' => '', 'href' => '', 'date' => '', 'date_total' => false])

<div class="flex items-center m-1 p-4 border-2 rounded-lg shadow-xs border-primary-700 bg-primary-100 ">
    <div class="p-3 mr-4 text-primary-700 bg-primary-200 rounded-full ">
      {{$slot}}
    </div>

    <div>
        <a href="{{$href}}">
            <p class="mb-2 text-lg font-semibold text-gray-800 hover:underline">
                {{$title}}
            </p>
        </a>
        <p class="text-sm font-semibold text-gray-700">
            ${{number_format($date, 2,",",".")}}
        </p>
    </div>

</div>