@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Coinex')
<img width="120" src="{{ asset('assets/logo.png') }}" alt="Coinex Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
