
    <h4>Order Details</h4>  
    <div id="order-details" class="mt-2">  
        <table class="table table-bordered">  
            <thead>  
                <tr>  
                    <th>Product</th>  
                    <th>Quantity</th>  
                    <th>Price</th>  
                    <th>Total</th>  
                </tr>  
            </thead>  
            <tbody id="order-details-list">  
                @php 
                    $total = 0;
                @endphp

                @foreach($order->product as $product)
                    @php
                        $lineTotal = $product->pivot->quantity * $product->pivot->price;
                        $total += $lineTotal;
                    @endphp
                    <tr>  
                        <td>{{ $product->name }}</td>  
                        <td>{{ $product->pivot->quantity }}</td>  
                        <td>{{ $product->pivot->price }}</td>  
                        <td>{{ number_format($lineTotal, 2) }}</td>  
                    </tr>
                @endforeach

                <tr>  
                    <td colspan="3" class="text-end">Total</td>  
                    <td>{{ number_format($total, 2) }}</td>
                </tr>

            </tbody>
        </table>
    </div>
