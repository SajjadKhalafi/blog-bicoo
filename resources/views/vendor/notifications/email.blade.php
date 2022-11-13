@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('اوه!')
@else
# @lang('سلام!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('با احترام'),<br>
وب آموز
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
"اگر با کلیک بر روی دکمه بالا مشکل دارید، آدرس زیر را کپی کرده و در مرورگر وب خود جایگذاری کنید:"
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
{{--    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".--}}
{{--    'into your web browser:',--}}
{{--[--}}
{{--'actionText' => $actionText,--}}
{{--]--}}
