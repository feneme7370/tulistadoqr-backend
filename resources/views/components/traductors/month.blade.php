@props([
    'month' => '',
    'format_month' => '',
])

@if ($format_month === 'complete' && $month === '01')<span>Enero</span>@endif
@if ($format_month === 'complete' && $month === '02')<span>Febrero</span>@endif
@if ($format_month === 'complete' && $month === '03')<span>Marzo</span>@endif
@if ($format_month === 'complete' && $month === '04')<span>Abril</span>@endif
@if ($format_month === 'complete' && $month === '05')<span>Mayo</span>@endif
@if ($format_month === 'complete' && $month === '06')<span>Junio</span>@endif
@if ($format_month === 'complete' && $month === '07')<span>Julio</span>@endif
@if ($format_month === 'complete' && $month === '08')<span>Agosto</span>@endif
@if ($format_month === 'complete' && $month === '09')<span>Septiembre</span>@endif
@if ($format_month === 'complete' && $month === '10')<span>Octubre</span>@endif
@if ($format_month === 'complete' && $month === '11')<span>Noviembre</span>@endif
@if ($format_month === 'complete' && $month === '12')<span>Diciembre</span>@endif

@if ($format_month === 'short' && $month === '01')<span>Ene</span>@endif
@if ($format_month === 'short' && $month === '02')<span>Feb</span>@endif
@if ($format_month === 'short' && $month === '03')<span>Mar</span>@endif
@if ($format_month === 'short' && $month === '04')<span>Abr</span>@endif
@if ($format_month === 'short' && $month === '05')<span>May</span>@endif
@if ($format_month === 'short' && $month === '06')<span>Jun</span>@endif
@if ($format_month === 'short' && $month === '07')<span>Jul</span>@endif
@if ($format_month === 'short' && $month === '08')<span>Ago</span>@endif
@if ($format_month === 'short' && $month === '09')<span>Sep</span>@endif
@if ($format_month === 'short' && $month === '10')<span>Oct</span>@endif
@if ($format_month === 'short' && $month === '11')<span>Nov</span>@endif
@if ($format_month === 'short' && $month === '12')<span>Dic</span>@endif