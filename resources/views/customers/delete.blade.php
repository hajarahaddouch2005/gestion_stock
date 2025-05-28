@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>Delete Customer</h3>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Are you sure you want to delete the customer "{{$customer->first_name}} {{$customer->last_name}}"?</h5>  
        <form action="{{ route('customers.delete' , $customer->id) }}" method="POST">  
            @csrf  
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button> 
            <a href="{{ route('customers') }}" class="btn btn-light">Cancel</a>
        </form>  
    </div>
</div>
@endsection 