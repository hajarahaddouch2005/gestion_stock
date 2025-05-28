@extends('layout.app')  
@section('content')  
<form action="{{ route('customers.add') }}" method="POST">  
    @csrf  
    <div class="form-group mb-1">  
        <label for="first_name">First Name</label>  
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>  
        @error('first_name')  
            <div class="invalid-feedback">{{ $message }}</div>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="last_name">Last Name</label>  
        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>  
        @error('last_name')  
            <div class="invalid-feedback">{{ $message }}</div>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="email">Email</label>  
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}" required>  
        @error('email')  
            <div class="invalid-feedback">{{ $message }}</div>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="address">Address</label>  
        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Address" value="{{ old('address') }}">  
        @error('address')  
            <div class="invalid-feedback">{{ $message }}</div>  
        @enderror  
    </div>  
    
    <div class="form-group mb-1">  
        <label for="phone">Phone Number</label>  
        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">  
        @error('phone')  
            <div class="invalid-feedback">{{ $message }}</div>  
        @enderror  
    </div>  
    
    <button type="submit" class="btn btn-primary">Submit</button>  
</form>  
@endsection  