<x-mail::message>
# Your Order is confirmed. 

Thank you for your order! We're excited to serve you. Here are the details of your order.
<x-mail::button :url="route('orders.show', ['order' => $order->id])" color="green">
View Order
</x-mail::button>

### Purchased Items
<x-mail::table>
    | NAME          | QUANTITY      | UNIT PRICE   | TOTAL   |
    |:--------------|:--------------|:-------------|:--------|
    @foreach ($order->items as $item)
    |{{$item->name}}| {{$item->pivot->quantity}} | ${{$item->price}}  | ${{$item->price * $item->pivot->quantity}}   | 
    @endforeach
</x-mail::table>

### Order Summary

Order Id: {{$order->id}}

Ordered On: {{$order->order_date}}

Status: {{$order->status}}

Total: ${{$order->total_amount}}<br><br>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>