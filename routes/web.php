<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


Route::get('/customers/print', [CustomerController::class, 'print'])->name('customers.print');



//lang
Route::get('/changeLocale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'es', 'fr', 'ar'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
});

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('/customers', [DashboardController::class, 'customers'])->middleware('auth')->name('customers');
    Route::get('/suppliers', [DashboardController::class, 'suppliers'])->middleware('auth')->name('suppliers');
    Route::get('/products', [DashboardController::class, 'products'])->middleware('auth')->name('products');

//Products
Route::post('/products', [ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::get('/api/products/{product}', [ProductController::class, 'show'])->middleware('auth')->name('api.products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->middleware('auth')->name('products.update');
Route::get('/by-category', [ProductController::class, 'byCategory'])->middleware('auth')->name('product.by.category');
Route::get('/by-category/{category}', [ProductController::class, 'byCategoryX'])->middleware('auth')->name('product.by.category.x');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('auth')->name('products.destroy');

Route::get('/products-by-supplier', [DashboardController::class, 'productsBySupplier'])->name('products.by.supplier');
Route::get('/api/products-by-supplier/{supplier}', [DashboardController::class, 'getProductsBySupplier'])->name('api.products.by.supplier');
Route::get('/products-by-store', [DashboardController::class, 'productsByStore'])->name('products.by.store');
Route::get('/api/products-by-store/{store}', [DashboardController::class, 'getProductsByStore'])->name('api.products.by.store');

Route::get('/products/search', [ProductController::class, 'search'])->middleware('auth')->name('products.search');

//Orders
Route::get('/by-customer', [OrderController::class, 'index'])->middleware('auth')->name('product.by.order');
Route::get('/by-customer/{customer}', [OrderController::class, 'getOrdersByCustomer'])->middleware('auth')->name('product.by.order.x');

//Customers
Route::get('/customer/addForm', [CustomerController::class, 'addForm'])->middleware('auth')->name('customers.addForm');
Route::get('/customer/updateForm/{id}', [CustomerController::class, 'updateForm'])->middleware('auth')->name('customers.updateForm');
Route::get('/customer/deleteForm/{id}', [CustomerController::class, 'deleteForm'])->middleware('auth')->name('customers.deleteForm');

Route::get('/customer/search/{term}', [CustomerController::class, 'search'])->middleware('auth')->name('customers.search');
Route::get('/customer/search1/{term}', [CustomerController::class, 'search1'])->middleware('auth')->name('customers.search');

Route::post('/customer/add', [CustomerController::class, 'add'])->middleware('auth')->name('customers.add');
Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->middleware('auth')->name('customers.update');
Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->middleware('auth')->name('customers.delete');


//Suppliers
Route::get('/supplier/addForm', [SupplierController::class, 'addForm'])->middleware('auth')->name('suppliers.addForm');
Route::post('/supplier/add', [SupplierController::class, 'add'])->middleware('auth')->name('suppliers.add');
Route::get('/supplier/updateForm/{id}', [SupplierController::class, 'updateForm'])->middleware('auth')->name('suppliers.updateForm');
Route::post('/supplier/update/{id}', [SupplierController::class, 'update'])->middleware('auth')->name('suppliers.update');
Route::get('/supplier/deleteForm/{id}', [SupplierController::class, 'deleteForm'])->middleware('auth')->name('suppliers.deleteForm');
Route::delete('/supplier/delete/{id}', [SupplierController::class, 'delete'])->middleware('auth')->name('suppliers.delete');

//Orders
Route::get('/orders/by-customer',[OrderController::class, 'index1'])->middleware('auth')->name('orders');
Route::get('/orders/by-customer/{customerId}', [OrderController::class, 'getOrdersByCustomer1'])->middleware('auth')->name('orders.by.customer');
Route::get('/orders/by-customer/orderDetails/{orderId}', [OrderController::class, 'getOrderDetails1'])->middleware('auth')->name('orders.details');
////by view
Route::get('/orders/by-customer-view',[OrderController::class, 'index2'])->middleware('auth')->name('orders.view');
Route::get('/orders/by-customer-view/{customerId}', [OrderController::class, 'getOrdersByCustomer2'])->middleware('auth')->name('orders.by.customer.view');
Route::get('/orders/by-customer-view/orderDetails/{orderId}', [OrderController::class, 'getOrderDetails2'])->middleware('auth')->name('orders.details.view');





//sql
Route::get('ordered_products', [ProductController::class, 'orderedProducts'])->middleware('auth')->name('ordered.products');
Route::get('orderLike/{customerName}', [CustomerController::class, 'orderLike'])->middleware('auth')->name('order.like');
Route::get('orders.product', [ProductController::class, 'ordersCount'])->middleware('auth')->name('orders.product');


//send Email
Route::get('email', [EmailController::class, 'index'])->middleware('auth')->name('email.form');
Route::post('email/send', [EmailController::class, 'send'])->middleware('auth')->name('email.send');

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Email Verification Routes
Route::get('/email/verify', [AuthController::class, 'verificationNotice'])->name('verification.notice');
Route::get('/email/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// Password Reset Routes
Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/password/reset/{token}/{email}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Profile Routes
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::put('/password', [AuthController::class, 'updatePassword'])->name('password.change');




Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');
Route::post('/customers/import', [CustomerController::class, 'import'])->name('customers.import');



//ssession
Route::post("/saveCookie", [DashboardController::class, 'saveCookie'])->name("saveCookie");
Route::post("/saveSession", [DashboardController::class, 'saveSession'])->name("saveSession");





Route::get('/ordered-products', [ProductController::class, 'orderedProducts'])->name('ordered.products');
Route::get('/same-products-customers', [CustomerController::class, 'sameProductsCustomers'])->name('same.products.customers');
Route::get('products/orders-count', [ProductController::class, 'ordersCount'])->name('products.orders_count');
Route::get('/products-more-than-6-orders', [ProductController::class, 'productsMoreThan6Orders'])->name('products.more_than_6_orders');
Route::get('/order-totals', [OrderController::class, 'orderTotals'])->name('orders.totals');
Route::get('/orders-greater-than-60', [OrderController::class, 'ordersGreaterThanOrder60'])->name('orders.greater_than_60');

Route::get('/customers/orders', [StoreController::class, 'customers_orders'])->name('customers.orders');
Route::get('/suppliers/products', [StoreController::class, 'suppliers_products'])->name('suppliers.products');
Route::get('products/same_stores', [StoreController::class, 'products_same_stores'])->name('products.same_stores');
Route::get('/products/countbystore', [StoreController::class, 'countbystore'])->name('products.countbystore');
Route::get('/store/value', [StoreController::class, 'storeValue'])->name('store.value');
Route::get('/sotre/greater_than_lind', [StoreController::class, 'storeGreater_than_lind'])->name('sotre.greater_than_lind');
