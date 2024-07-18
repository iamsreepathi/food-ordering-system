<x-mail::message>
# Newsletter Subscription

Welcome to {{config('app.name')}}. You are successfully subscribed to our newsletter.
You can view our monthly newsletters below link.

<x-mail::button :url="config('app.url')" color="green">
Newsletters
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>