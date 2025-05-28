@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>Delete Supplier</h3>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Are you sure you want to delete this supplier?</h5>  
        <form action="{{ route('suppliers.delete' , $supplier->id) }}" method="POST">  
            @csrf  
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button> 
            <a href="{{ route('suppliers') }}" class="btn btn-light">Cancel</a>
        </form>  
    </div>
</div>
@endsection 