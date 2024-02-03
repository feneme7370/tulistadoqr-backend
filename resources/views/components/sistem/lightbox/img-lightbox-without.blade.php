@props(['uri' => '', 'name' => ''])

<div {{ $attributes->merge(['class' => '']) }}>       

    <a href="{{asset('archives/sistem/img/withoutImage.jpg')}}" data-lightbox="withoutImage.jpg">
        <img class="w-full object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
    </a>
    

    @push('lightbox')
        <script>
            lightbox.option({
            'alwaysShowNavOnTouchDevices': true,
            'showImageNumberLabel': true,
            'imageFadeDuration': 1000,
            'resizeDuration': 1000,
            'fadeDuration': 1000,
            'disableScrolling': true,
            'wrapAround': true,
            })
        </script>
    @endpush



</div>
