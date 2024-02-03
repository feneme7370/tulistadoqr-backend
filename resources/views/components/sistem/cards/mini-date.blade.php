@props(['title', 'href', 'date', 'icon', 'date_total' => false])

<div class="flex items-center m-1 p-4 border-2 border-purple-700 rounded-lg shadow-xs ">
    <div class="p-3 mr-4 text-purple-700 bg-purple-100 rounded-full dark:text-gray-100 dark:bg-gray-500">

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