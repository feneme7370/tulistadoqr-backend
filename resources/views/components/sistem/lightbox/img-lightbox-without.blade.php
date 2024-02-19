@props(['uri' => '', 'name' => ''])

<div {{ $attributes->merge(['class' => '']) }}>       

    <a href="{{asset('archives/sistem/img/withoutImage.jpg')}}" data-lightbox="withoutImage.jpg">
        <img class="w-full object-cover rounded-sm" src="{{asset('archives/sistem/img/withoutImage.jpg')}}">
    </a>
    

    @push('scripts')
        <script>
            lightbox.option({
            'alwaysShowNavOnTouchDevices': true,
            'showImageNumberLabel': true,
            'imageFadeDuration': 100,
            'resizeDuration': 100,
            'fadeDuration': 100,
            'disableScrolling': true,
            'wrapAround': true,
            })
        </script>
    @endpush



</div>
