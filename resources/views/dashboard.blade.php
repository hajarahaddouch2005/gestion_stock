@extends('layout.app')
@section('content')
    <div class="header-actions d-flex justify-between align-center">
        <h4>Welcome {{$user->name}}</h4>
        <a href="{{route('email.form')}}" class="btn btn-primary">Send Email</a>
    </div>
    <div class="m-auto d-flex flex-column align-center">
        <h1 class="fs-1 text-dark">@lang('Welcome')</h1>
        <h4 class="text-gray fs-small">@lang('Slogon')</h4>
        <div class="container d-flex justify-center gap-1 flex-wrap">
            <a href="{{route('customers')}}" class="btn btn-danger">@lang('List of Customers')</a>
            <a href="{{route('suppliers')}}" class="btn btn-dark">@lang('List of Suppliers')</a>

            <a href="{{route('products')}}" class="btn btn-primary">Products by Category</a>
            <a href="/products-by-supplier"  class="btn btn-danger">Products by Supplier</a>
            <a href="/products-by-store"  class="btn btn-primary">Products by Store</a>
            <a href="{{route('product.by.order')}}" class="btn btn-warning">Orders</a>
            <a href="{{route('orders')}}" class="btn btn-primary">Orders (JS method)</a>
            <a href="{{route('orders.view')}}" class="btn btn-secondary">Orders (views method)</a>
        </div>
    </div>

    <br><br>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('ordered.products') }}" class="btn btn-info mb-3">View Ordered Products </a>
        <a href="{{ route('same.products.customers') }}" class="btn btn-warning mb-3">Customers Who Ordered the Same
            Products as Annabel Stehr</a>
        <a href="{{ route('products.orders_count') }}" class="btn btn-dark mb-3">Show Number of Orders per Product</a>
        <a href="{{ route('products.more_than_6_orders') }}" class="btn btn-primary mb-3">Products with More Than 6
            Orders</a>
        <a href="{{ route('orders.totals') }}" class="btn btn-danger mb-3">Show Total Amount per Order</a>
        <a href="{{ route('orders.greater_than_60') }}" class="btn btn-secondary mb-3">Orders with Total Greater Than
            Order 60</a>

    </div>

    <br><br>
    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('customers.orders') }}" class="btn btn-info mb-3">la requête-1</a>
        <a href="{{ route('suppliers.products') }}" class="btn btn-warning mb-3">la requête-2</a>
        <a href="{{ route('products.same_stores') }}" class="btn btn-dark mb-3">la requête-3</a>
        <a href="{{ route('products.countbystore') }}" class="btn btn-primary mb-3">la requête-4</a>
        <a href="{{ route('store.value') }}" class="btn btn-danger mb-3">la requête-5</a>
        <a href="{{ route('sotre.greater_than_lind') }}" class="btn btn-secondary mb-3">la requête-6</a>

    </div>


    <br><br><br>
    <div class="container mt-4">
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Session</h4>
        </div>
        <div class="card-body">
            <h5 class="mb-3">
                Hello from session:
                @if(Session::has("SessionName"))
                    <span class="text-success">{{ Session("SessionName") }}</span>
                @else
                    <span class="text-muted">No session value</span>
                @endif
            </h5>

            <form method="POST" action="{{ url('saveSession') }}">
                @csrf
                <div class="mb-3">
                    <label for="txtSession" class="form-label">Type your name</label>
                    <input type="text" id="txtSession" name="txtSession" class="form-control" placeholder="Your name..." required>
                </div>
                <button type="submit" class="btn btn-secondary">Save Session</button>
            </form>
        </div>
         <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cookies</h4>
        </div>
        <div class="card-body">
            <h5 class="mb-3">
                Hello from cookies:
                @if(Cookie::has("UserName"))
                    <span class="text-success">{{ Cookie::get("UserName") }}</span>
                @else
                    <span class="text-muted">No cookie value</span>
                @endif
            </h5>

            <form method="POST" action="{{ url('saveCookie') }}">
                @csrf
                <div class="mb-3">
                    <label for="txtCookie" class="form-label">Type your name</label>
                    <input type="text" id="txtCookie" name="txtCookie" class="form-control" placeholder="Your name..." required>
                </div>
                <button type="submit" class="btn btn-primary">Save Cookie</button>
            </form>
        </div>
    </div>
    </div>


<style>
    :root {
        --primary-color: #6c63ff;
        --primary-hover: #5a52d4;
        --text-dark: #3e3f5e;
        --bg-light: #f8f9fa;
        --bg-dark: #1a1a2e;
        --text-light: #ffffff;
    }

    .container {
        max-width: 1200px;
        padding: 2rem 1rem;
    }

    .header-actions {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    body.dark .header-actions {
        background: var(--bg-dark);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .header-actions h4 {
        color: var(--text-dark);
        font-weight: 700;
        margin: 0;
    }

    body.dark .header-actions h4 {
        color: var(--text-light);
    }

    .fs-1 {
        font-size: 2.5rem !important;
        font-weight: 700;
        color: var(--text-dark);
    }

    body.dark .fs-1 {
        color: var(--text-light);
    }

    .text-gray.fs-small {
        color: #6c757d !important;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    body.dark .text-gray.fs-small {
        color: #a0a0c0 !important;
    }

    .d-flex.justify-center {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    body.dark .d-flex.justify-center {
        background: var(--bg-dark);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .d-flex.justify-content-center.gap-3 {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    body.dark .d-flex.justify-content-center.gap-3 {
        background: var(--bg-dark);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .btn {
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 160px;
        text-align: center;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background: #5c636a;
    }

    body.dark .btn-secondary {
        background: #4a4a6a;
    }

    body.dark .btn-secondary:hover {
        background: #5c636a;
    }

    .btn-success {
        background: #28a745;
        border: none;
    }

    .btn-success:hover {
        background: #218838;
    }

    .btn-danger {
        background: #dc3545;
        border: none;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .btn-warning {
        background: #ffc107;
        border: none;
        color: #212529;
    }

    .btn-warning:hover {
        background: #e0a800;
    }

    .btn-info {
        background: #17a2b8;
        border: none;
    }

    .btn-info:hover {
        background: #138496;
    }

    .btn-dark {
        background: #343a40;
        border: none;
    }

    .btn-dark:hover {
        background: #23272b;
    }

    body.dark .btn-dark {
        background: #4a4a6a;
    }

    body.dark .btn-dark:hover {
        background: #5c636a;
    }

    .card {
        background: var(--bg-light);
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background 0.3s ease;
    }

    body.dark .card {
        background: var(--bg-dark);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .card-header {
        border-radius: 12px 12px 0 0;
        padding: 1rem 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-control {
        border-radius: 8px;
        border: 1.5px solid #c8c8d8;
        padding: 0.75rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 8px rgba(108, 99, 255, 0.3);
        outline: none;
    }

    body.dark .form-control {
        background: #2c2c54;
        border-color: #4a4a6a;
        color: var(--text-light);
    }

    .form-label {
        color: var(--text-dark);
        font-weight: 500;
        text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};
    }

    body.dark .form-label {
        color: var(--text-light);
    }

    /* RTL Adjustments */
    [dir="rtl"] .header-actions {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .justify-between {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .justify-center {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .justify-content-center {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .form-label {
        text-align: right;
    }

    [dir="rtl"] .btn {
        margin-left: 0;
        margin-right: 0.5rem;
    }
</style>
@endsection
