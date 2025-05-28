<h4>Orders</h4>
<div id="order-list" class="mt-2">
    @foreach($orders as $order)  
        <a href="#" class="btn" onclick="getOrderDetails({{ $order->id }})">{{$order->id}} - {{$order->order_date}}</a><br/>
    @endforeach  
</div>    