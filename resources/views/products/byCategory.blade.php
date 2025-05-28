@extends('layout.app')

@section('content')

<div class="d-flex justify-between mb-3">
    <h1 class="fs-1 text-dark">Products by Category</h1>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
<div class="container">
    <div class="row">
        <select class="form-select" name="category" id="category" onchange="window.location.href=this.options[this.selectedIndex].value;">
            <option value="{{route('product.by.category')}}">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ route('product.by.category.x', $category) }}" 
                    {{ request()->route('category')?->id === $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    <div class="card">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Stock</th>
                <th scope="col">Supplier</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                  <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->stock?->quantity ?? 'N/A'}}</td>
                    <td>{{$product->supplier->first_name}} {{$product->supplier->last_name}}</td>
                  </tr>
              @empty
                  <tr>
                    <td colspan="4" class="text-center">No products found for this category.</td>
                  </tr>
            @endforelse
            </tbody>
          </table>
    </div>
    </div>
</div>
@endsection