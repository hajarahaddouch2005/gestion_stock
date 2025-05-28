@extends('layout.app')
@section('content')
<div class="container mt-4">  
    <h3>Orders by Customer</h3>  
    <div class="d-flex flex-row">  
        <form id="search-form" class="me-2">  
            <div class="input-group">  
                <input type="text" name="search" id="search" class="form-control" placeholder="Enter customer...">  
                <button class="btn btn-light" type="submit">Search</button>  
            </div>  
        </form>
        <div id="customer-section" hidden>
        </div>
    </div>  
    <div class="d-flex mt-4">  
        <div id="orders-section" class="flex-fill" hidden>
        </div>
        <div id="order-details-section" class="flex-fill" hidden></div>
    </div>
@endsection

@push('script')  
<script>  
    $(document).ready(function() {  
        $('#search-form').on('submit', function(e) {  
            e.preventDefault();  
            const searchTerm = $('#search').val().trim();  

            axios.get('/customer/search1/' + encodeURIComponent(searchTerm)).then(function(response) {
                $('#customer-section').removeAttr('hidden');
                $('#customer-section').html(response.data);
            })  
        });  
    });  

    function getOrders(customerId) {   
            toggleList();  
            axios.get('/orders/by-customer-view/' + customerId).then(function(response) {  
                $('#orders-section').removeAttr('hidden');  
                $('#orders-section').html(response.data);

            }).catch(function(error) {  
                console.error(error);  
            });  
        }  

        function getOrderDetails(orderId) {   
        var total = 0;
        console.log('orderId', orderId);
        axios.get('/orders/by-customer-view/orderDetails/' + orderId).then(function(response) {  
            $('#order-details-section').empty();  
            $('#order-details-section').append(response.data);

            $('#order-details-section').removeAttr('hidden');  
        }).catch(function(error) {  
            console.error(error);  
        });  
    }  
</script>
@endpush