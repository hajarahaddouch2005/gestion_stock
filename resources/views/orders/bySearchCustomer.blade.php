@extends('layout.app')  
@section('content')  
<div class="container mt-4">  
    <h3>Orders by Customer</h3>  
    <div class="d-flex">  
        <form id="search-form" class="me-2">  
            <div class="input-group">  
                <input type="text" name="search" id="search" class="form-control" placeholder="Enter customer...">  
                <button class="btn btn-light" type="submit">Search</button>  
            </div>  
        </form>  

        <div id="customer-section" hidden>  
            <div class="d-flex justify-content-between align-items-center">  
                <h4>Customers Found</h4>  
                <button class="btn btn-outline-secondary" onclick="toggleList()">Toggle List</button>  
            </div>  
            <div id="list-customers" class="mt-2">  
                <div>No customer found</div>  
            </div>  
        </div>  
    </div>  

    <div class="d-flex mt-4">  
        <div id="orders-section" class="flex-fill" hidden>  
            <h4>Orders</h4>  
            <div id="order-list" class="mt-2"></div>    
            <div id="order-details-section" class="flex-fill" hidden>  
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
                        
                        </tbody>  
                    </table>  
                </div>  
            </div>  
        </div>
    </div>  
</div>  
@endsection  

@push('script')  
<script>  
    $(document).ready(function() {  
        $('#search-form').on('submit', function(e) {  
            e.preventDefault();  
            const searchTerm = $('#search').val().trim();  

            axios.get('/customer/search/' + encodeURIComponent(searchTerm))  
                .then(function(response) {  
                    console.log(response.data);  
                    $('#list-customers').empty();  
                    if (response.data.length > 0) {  
                        response.data.forEach(function(customer) {  
                            $('#list-customers').append(`<a href="#" class="btn" onclick="getOrders(${customer.id})"> ${customer.first_name} ${customer.last_name} </a><br/>`);  
                        });  
                    } else {  
                        $('#list-customers').append('<div>No customer found</div>');  
                    }  
                    $('#customer-section').removeAttr('hidden');  
                })  
                .catch(function(error) {  
                    console.error(error);  
                });  
        });  
    });  

    function getOrders(customerId) {  
        console.log(customerId);  
        toggleList();  
        axios.get('/orders/by-customer/' + customerId).then(function(response) {  
            console.log(response.data);  
            $('#order-list').empty();  
            if (response.data.length > 0) {  
                response.data.forEach(function(order) {  
                    $('#order-list').append(`<a href="#" class="btn" onclick="getOrderDetails(${order.id})">${order.id} - ${order.order_date}</a><br/>`);  
                });  
            } else {  
                $('#order-list').append('<div>No orders found for this customer</div>');  
            }  
            $('#orders-section').removeAttr('hidden');  
        }).catch(function(error) {  
            console.error(error);  
        });  
    }  

    function getOrderDetails(orderId) {  
        console.log(orderId);  
        var total = 0;
        axios.get('/orders/by-customer/orderDetails/' + orderId).then(function(response) {  
            console.log('order details', response.data);  
            $('#order-details-list').empty();  
            const products = response.data.product;  
            products.forEach(function(product) {  
                const quantity = product.pivot.quantity;  
                const price = product.pivot.price; 
                total += quantity * price; 
                $('#order-details-list').append(`<tr><td>${product.name}</td><td>${quantity}</td><td>${price}</td><td>${(quantity * price).toFixed(2)}</td></tr>`);  
            });  
            $('#order-details-list').append(`<tr><td colspan="3" class="text-end">Total</td><td>${total.toFixed(2)}</td></tr>`);

            $('#order-details-section').removeAttr('hidden');  
        }).catch(function(error) {  
            console.error(error);  
        });  
    }  

    function toggleList() {    
        $('#list-customers').collapse('toggle');  
    }  
</script>  
@endpush  