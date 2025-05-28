@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>List of Suppliers</h3>
    <a href="{{route('suppliers.addForm')}}" class="btn btn-success">Add Supplier</a>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($suppliers as $supplier)
              <tr>
                <td>{{$supplier->first_name}} {{$supplier->last_name}}</td>
                <td>{{$supplier->address}}</td>
                <td>{{$supplier->email}}</td>
                <td>{{$supplier->phone}}</td>
                <td>
                    <a href="{{route('suppliers.updateForm' , $supplier->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('suppliers.deleteForm' , $supplier->id)}}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection