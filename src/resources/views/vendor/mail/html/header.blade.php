@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; color:#48bb78">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
