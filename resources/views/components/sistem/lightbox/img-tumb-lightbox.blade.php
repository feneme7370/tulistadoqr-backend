@props(['uri' => '', 'name' => ''])

<div {{ $attributes->merge(['class' => '']) }}>       

    @if($name && !$name == '' && !$name == null)
        <a href="{{asset( $uri .$name)}}" data-lightbox="{{$name}}">
            <img src="{{asset( $uri . 'tumb_' . $name)}}" alt="imagen portada" class="w-full h-full object-cover rounded-sm"/>
        </a>
    @else
        <a href="{{asset('archives/sistem/img/withoutImage.jpg')}}" data-lightbox="withoutImage.jpg">
            <img class="w-full object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
        </a>
    @endif

    

    @push('lightbox')
        <script>
            lightbox.option({
            'alwaysShowNavOnTouchDevices': true,
            'showImageNumberLabel': true,
            'imageFadeDuration': 1000,
            'resizeDuration': 100,
            'fadeDuration': 100,
            'disableScrolling': true,
            'wrapAround': true,
            })
        </script>
    @endpush



</div>
