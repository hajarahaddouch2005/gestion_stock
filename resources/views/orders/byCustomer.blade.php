@extends('layout.app')

@section('content')

<div class="d-flex justify-between mb-3">
    <h1 class="fs-1 text-dark">Order by Customer</h1>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
<div class="container">
    <div class="row">
        <select class="form-select" name="customer" id="customer">
            <option value="">Select Customer</option>
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="card">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Products</th>
                <th scope="col">Order Date</th>
                <th scope="col">Customer Name</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @forelse ($orders as $order)
                  <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->products}}</td>
                    <td>{{$order->order_date}}</td>
                    <td>{{$order->customer}}</td>
                  </tr>
              @empty
                  <tr>
                    <td colspan="4" class="text-center">No order found for this customer.</td>
                  </tr>
            @endforelse
            </tbody>
          </table>
    </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('#customer').change(function() {
            var selectedCustomer = $(this).val();
            if(selectedCustomer && selectedCustomer !== "Select Customer") {
                // Assuming customer id is in the value (I'll show you how to fix that below)
                $.ajax({
                    url: '/by-customer/' + selectedCustomer,
                    type: 'GET',
                    success: function(data) {
                        $('#tbody').empty();
                        if (data.length === 0) {
                            $('#tbody').append('<tr><td colspan="4" class="text-center">No orders found for this customer.</td></tr>');
                        } else {
                            $.each(data, function(index, order) {
                                console.log(order);
                                var productsList = order.product.map(function(product) {
                                    return product.name;
                                }).join('--');
    
                                $('#tbody').append('<tr>' +
                                    '<td>' + order.id + '</td>' +
                                    '<td>' + productsList + '</td>' +
                                    '<td>' + order.order_date + '</td>' +
                                    '<td>' + order.customer.first_name + ' ' + order.customer.last_name + '</td>' +
                                    '</tr>');
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endpush