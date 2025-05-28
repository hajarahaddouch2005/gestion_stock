@extends('layout.app')  
@section('content')  
<form action="{{ route('suppliers.update' , $supplier->id) }}" method="POST">  
    @csrf  
    <div class="form-group mb-1">  
        <label for="first_name">First Name</label>  
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name', $supplier -> first_name) }}">  
        @error('first_name')  
        <small class="text-danger">{{ $message }}</small>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="last_name">Last Name</label>  
        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name', $supplier -> last_name) }}">  
        @error('last_name')  
        <small class="text-danger">{{ $message }}</small>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="email">Email</label>  
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email' , $supplier -> email) }}">  
        @error('email')  
        <small class="text-danger">{{ $message }}</small>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="address">Address</label>  
        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Address" value="{{ old('address', $supplier -> address) }}">  
        @error('address')  
        <small class="text-danger">{{ $message }}</small>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="phone">Phone Number</label>  
        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone" value="{{ old('phone', $supplier -> phone) }}">  
        @error('phone')  
        <small class="text-danger">{{ $message }}</small>  
        @enderror  
    </div>  
    
    <button type="submit" class="btn btn-primary">Submit</button>  
</form>  
@endsection  