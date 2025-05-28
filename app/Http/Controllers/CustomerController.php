<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function addForm()
    {
        return view('customers.add');
    }

    public function add(CustomerRequest $request)
    {
        Customer::create($request->validated());
        return redirect()
            ->route('customers')
            ->with('success', 'Customer saved successfully');
    }

    public function updateForm($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.update', compact('customer'));
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->validated());
        return redirect()
            ->route('customers')
            ->with('success', 'Customer updated successfully');
    }

    public function deleteForm($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.delete', compact('customer'));
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()
            ->route('customers')
            ->with('success', 'Customer deleted successfully');
    }

    public function search($term)
    {
        $customers = Customer::where('first_name', 'LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->get();

        return response()->json($customers);
    }

    public function search1($term)
    {
        $customers = Customer::where('first_name', 'LIKE', "%$term%")
            ->orWhere('last_name', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->get();

        return view('orders.customersListView', compact('customers'));
    }

    public function orderLike($customerName)
    {
        $customer = Customer::where(DB::raw("CONCAT(first_name, ' ', last_name)"), '=', $customerName)->first();

        if (!$customer) {
            return view('products.orderLike', ['customers' => collect()]);
        }

        $productsIds = DB::table('product_orders')
            ->join('orders', 'product_orders.order_id', '=', 'orders.id')
            ->where('orders.customer_id', '=', $customer->id)
            ->pluck('product_orders.product_id');

        $customers = DB::table('product_orders')
            ->join('orders', 'product_orders.order_id', '=', 'orders.id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->where('customers.id', '!=', $customer->id)
            ->whereIn('products.id', $productsIds)
            ->select([
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                'customers.email as customer_email',
                'products.name as product_name',
                'orders.order_date as order_date',
            ])
            ->get();

        return view('customers.orderLike', compact('customers'));
    }

    public function sameProductsCustomers()
    {
        $customer = Customer::whereRaw("CONCAT(first_name, ' ', last_name) = ?", ['Annabel Stehr'])->first();

        if (!$customer) {
            return view('customers.same_products_customers', ['customers' => collect()]);
        }

        $productIds = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->where('orders.customer_id', $customer->id)
            ->pluck('product_orders.product_id');

        $customers = DB::table('orders')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->whereIn('product_orders.product_id', $productIds)
            ->where('orders.customer_id', '!=', $customer->id)
            ->select([
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                'customers.email',
                'products.name as product_name',
                'orders.order_date as order_date',
            ])
            ->orderBy('customer_name')
            ->get();

        return view('customers.same_products_customers', compact('customers'));
    }

    public function export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new CustomerImport, $request->file('file'));

        return back()->with('success', 'Customers imported successfully.');
    }
}