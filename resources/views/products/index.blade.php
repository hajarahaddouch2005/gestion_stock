@extends('layout.app')
@section('content')
<div class="d-flex justify-between mb-3">
    <h3>List of Products</h3>
    <button
    data-bs-target="#createProductModal"
    data-bs-toggle="modal"
    class="btn btn-success">Add Product</button>
    <a href="{{route('dashboard')}}" class="btn btn-light">To Dashboard</a>
</div>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
            <th scope="col">Supplier</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="productTableBody">
          @foreach ($products as $product)
              <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->category->name}}</td>
                <td>{{$product->supplier->first_name}} {{$product->supplier->last_name}}</td>
                <td>{{ $product->stock?->quantity ?? 'N/A' }}</td>
                <td>{{$product->price}}</td>
                <td>
                    @if($product->picture)
                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    <button data-bs-target="#editProductModal" data-name="{{ $product->name }}" data-id="{{$product->id}}" data-bs-toggle="modal" class="btn btn-primary edit-product">Edit</button>
                    <button data-bs-target="#deleteProductModal" data-name="{{ $product->name }}" data-id="{{$product->id}}" data-bs-toggle="modal" class="btn btn-danger delete-product">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('products.modals.import-modal')
@include('products.modals.delete-modal')
@include('products.modals.edit-modal')
@include('products.modals.add-modal')

@push('script')
<script>
    $(document).ready(function () {
        function attachEventHandlers() {
            $('.edit-product').on('click', function () {
                let productId = $(this).data('id');
                $.ajax({
                    url: `/api/products/${productId}`,
                    type: 'GET',
                    success: function (product) {
                        $('#editProductId').val(product.id);
                        $('#editName').val(product.name);
                        $('#editDescription').val(product.description);
                        $('#editPrice').val(product.price);
                        $('#editCategoryId').val(product.category_id);
                        $('#editSupplierId').val(product.supplier_id);
                        $('#editProductForm').attr('action', `/products/${productId}`);
                    },
                    error: function (xhr) {
                        console.error('Error fetching product data:', xhr);
                    }
                });
            });

            $('.delete-product').on('click', function () {
                let productId = $(this).data('id');
                let productName = $(this).data('name');

                $('#deleteProductId').val(productId);
                $('#productName').text(productName);
                $('#deleteProductForm').attr('action', `/products/${productId}`);
            });
        }

        $('#searchInput').on('keyup', function () {
            const query = $(this).val();

            axios.get("{{ route('products.search') }}", {
                params: { query: query }
            })
            .then(function (response) {
                const products = response.data;
                let rows = '';

                products.forEach(product => {
                    rows += `
                        <tr>
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td>${product.category?.name ?? ''}</td>
                            <td>${product.supplier?.first_name ?? ''} ${product.supplier?.last_name ?? ''}</td>
                            <td>${product.stock?.quantity ?? 'N/A'}</td>
                            <td>${product.price}</td>
                            <td>
                                ${product.picture ? `<img src="/storage/${product.picture}" alt="${product.name}" class="img-thumbnail" style="width: 50px; height: 50px;">` : '<span class="text-muted">No Image</span>'}
                            </td>
                            <td>
                                <button data-bs-target="#editProductModal" data-name="${product.name}" data-id="${product.id}" data-bs-toggle="modal" class="btn btn-primary edit-product">Edit</button>
                                <button data-bs-target="#deleteProductModal" data-name="${product.name}" data-id="${product.id}" data-bs-toggle="modal" class="btn btn-danger delete-product">Delete</button>
                            </td>
                        </tr>
                    `;
                });

                $('#productTableBody').html(rows);
                attachEventHandlers();
            })
            .catch(function (error) {
                console.error('Search error:', error);
            });
        });

        attachEventHandlers();
    });
</script>
@endpush

<style>
    :root {
        --primary-color: #3182ce; /* Blue-teal */
        --primary-hover: #2b6cb0;
        --text-dark: #1a202c; /* Dark gray */
        --text-light: #edf2f7; /* Light gray */
        --bg-light: #f7fafc; /* Off-white */
        --bg-dark: #1a202c; /* Dark gray */
        --accent-color: #38a169; /* Green for success */
        --warning-color: #d69e2e; /* Yellow for warning */
    }

    .container {
        max-width: 1280px;
        padding: 2rem 1.5rem;
        margin: 0 auto;
    }

    .d-flex.justify-between.mb-3 {
        align-items: center;
        padding: 1rem 0;
        border-bottom: 2px solid var(--primary-color);
        margin-bottom: 1.5rem;
    }

    body.dark .d-flex.justify-between.mb-3 {
        border-color: var(--primary-hover);
    }

    .d-flex.justify-between.mb-3 h3 {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.8rem;
        margin: 0;
        letter-spacing: -0.01em;
    }

    body.dark .d-flex.justify-between.mb-3 h3 {
        color: var(--text-light);
    }

    .d-flex.mb-3 {
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .alert.alert-success {
        background: var(--accent-color);
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    body.dark .alert.alert-success {
        background: #2f855a;
    }

    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: border-color 0.3s ease;
        flex-grow: 1;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 6px rgba(49, 130, 206, 0.3);
        outline: none;
    }

    body.dark .form-control {
        background: #2d3748;
        border-color: #4a5568;
        color: var(--text-light);
    }

    .btn {
        border-radius: 6px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
    }

    .btn-success {
        background: var(--accent-color);
        border: none;
        color: #ffffff;
    }

    .btn-success:hover {
        background: #2f855a;
    }

    .btn-warning {
        background: var(--warning-color);
        border: none;
        color: #1a202c;
    }

    .btn-warning:hover {
        background: #b7791f;
    }

    .btn-info {
        background: #4299e1;
        border: none;
        color: #ffffff;
    }

    .btn-info:hover {
        background: #2b6cb0;
    }

    .btn-light {
        background: #edf2f7;
        border: 1px solid #e2e8f0;
        color: var(--text-dark);
    }

    .btn-light:hover {
        background: #e2e8f0;
    }

    body.dark .btn-light {
        background: #2d3748;
        border-color: #4a5568;
        color: var(--text-light);
    }

    body.dark .btn-light:hover {
        background: #4a5568;
    }

    .btn-danger {
        background: #e53e3e;
        border: none;
        color: #ffffff;
    }

    .btn-danger:hover {
        background: #c53030;
    }

    .card {
        background: var(--bg-light);
        border: none;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    body.dark .card {
        background: var(--bg-dark);
    }

    .table {
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .thead-dark {
        background: var(--primary-color);
        color: #ffffff;
    }

    body.dark .thead-dark {
        background: var(--primary-hover);
    }

    .thead-dark th {
        font-weight: 600;
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
    }

    .table tbody tr {
        transition: background 0.2s ease;
    }

    .table tbody tr:hover {
        background: #edf2f7;
    }

    body.dark .table tbody tr:hover {
        background: #2d3748;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        color: var(--text-dark);
    }

    body.dark .table td {
        color: var(--text-light);
    }

    .img-thumbnail {
        border-radius: 4px;
        object-fit: cover;
    }

    .text-muted {
        color: #718096 !important;
    }

    body.dark .text-muted {
        color: #a0aec0 !important;
    }

    /* RTL Adjustments */
    [dir="rtl"] .d-flex.justify-between {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .d-flex.mb-3 {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .form-control {
        text-align: right;
    }

    [dir="rtl"] .btn {
        margin-left: 0;
        margin-right: 0.5rem;
    }

    [dir="rtl"] .float-end {
        float: left !important;
    }
</style>
@endsection
