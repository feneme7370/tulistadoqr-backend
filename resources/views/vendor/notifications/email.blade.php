<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hola!')
@endif
@endif

{{-- Intro Lines --}}
{{-- @foreach ($introLines as $line)
{{ $line }}

@endforeach --}}
{{ 'Por favor, haga click en el boton para verificar su correo.' }}

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
{{-- {{ $actionText }} --}}
{{ 'Verificar Correo' }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
{{-- @foreach ($outroLines as $line)
{{ $line }}

@endforeach --}}
{{ 'Si usted no creo una cuenta, omita este mensaje.' }}

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Femaser'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "Si tienes problemas para dar click en el boton \":actionText\", copia y pega la url\n".
    'en el navegador:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
