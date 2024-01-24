@props(['title', 'href', 'date', 'icon', 'date_total' => false])

<div class="flex items-center m-1 p-4 bg-white border-2 border-gray-400 rounded-lg shadow-xs ">
    <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full dark:text-purple-100 dark:bg-purple-500">

      {{$slot}}
    </div>

    <div>
        <a href="{{$href}}">
            <p class="mb-2 text-lg font-semibold text-gray-600 hover:underline">
                {{$title}}
            </p>
        </a>
        <p class="text-sm font-semibold text-gray-700 ">
            {{$date}} / {{$date_total}}
        </p>
    </div>

  </div>