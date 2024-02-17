@props(['title', 'href', 'date', 'icon', 'date_total' => false])

<div class="flex items-center m-1 p-4 border-2 rounded-lg shadow-xs border-primary-700 dark:border-gray-800 bg-primary-100 dark:bg-slate-700">
    <div class="p-3 mr-4 text-primary-700 dark:text-gray-100 bg-primary-200 dark:bg-gray-600 rounded-full ">

      {{$slot}}
    </div>

    <div>
        <a href="{{$href}}">
            <p class="mb-2 text-lg font-semibold text-gray-800 dark:text-gray-200 hover:underline">
                {{$title}}
            </p>
        </a>
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
            {{$date}} / {{$date_total}}
        </p>
    </div>

  </div>