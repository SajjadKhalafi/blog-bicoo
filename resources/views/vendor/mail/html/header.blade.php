<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('blog/img/weblogo.png') }}" class="logo" alt="Laravel Logo"
                     style="height: auto !important;
                            width: 100% !important;">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
