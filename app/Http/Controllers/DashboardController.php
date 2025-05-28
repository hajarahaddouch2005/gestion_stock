<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Store;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard', ['user' => Auth::user()]);
    }






    public function customers() {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function suppliers(){
        $suppliers = Supplier::all();
        return view('suppliers.index',compact('suppliers'));
    }

    public function products(){
        $products = Product::with(['category', 'supplier', 'stock'])
                    ->get();

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.index',compact('products', 'categories', 'suppliers'));
    }

    public function productsBySupplier(): View
    {
        $suppliers = Supplier::all();
        return view('products.by-supplier', compact('suppliers'));

    }

    public function getProductsBySupplier(Supplier $supplier)
    {

        $products = Product::with(['stock','category'])
        ->where('supplier_id', $supplier->id)
        ->get();
        return view('products._products_by_supplier', compact('products'));
    }

    public function productsByStore(): View
    {
        $stores = Store::all();
        return view('products.by-store', compact('stores'));
    }

    public function getProductsByStore(Store $store)
    {
        $products = Product::with(['category', 'stock'])
            ->whereHas('stock', function($query) use ($store) {
                $query->where('store_id', $store->id);
            })
            ->get();

        return response()->json($products);
    }

    public function saveCookie()
    {
        $name = request()->input("txtCookie");
        Cookie::queue("UserName",$name,6000000);
        return redirect()->back();
    }


    public function saveSession(Request $request)
    {
                $name = $request->input("txtSession");
                $request->session()->put('SessionName', $name);
                return redirect()->back();
    }

}
