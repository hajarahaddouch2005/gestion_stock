<div class="d-flex justify-content-between align-items-center">  
        <h4>Customers Found</h4>  
        <button class="btn btn-outline-secondary" onclick="toggleList()">Toggle List</button>  
    </div>  
    <div id="list-customers" class="mt-2">  
        @foreach($customers as $customer)  
            <a href="#" class="btn" onclick="getOrders({{ $customer->id }})">  
                {{ $customer->first_name }} {{ $customer->last_name }}  
            </a><br/>  
        @endforeach  
</div>  

<script>
        function toggleList() {    
            $('#list-customers').collapse('toggle');  
        }
</script>
