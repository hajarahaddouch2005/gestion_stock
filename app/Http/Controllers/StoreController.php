<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function  customers_orders()
    {
        $orders = Order::join("customers","orders.customer_id","=","customers.id")
        ->select(DB::raw("concat(customers.first_name, ' ', customers.last_name) as customer_name"),"orders.id as order_id", "orders.order_date as order_date")
        ->get();



        return view('stores.customers_orders', compact('orders'));
    }

    public function  suppliers_products()
    {
        $productIds = Customer::where("customers.first_name","Annabel")
        ->where("customers.last_name","Stehr")
        ->join("orders","customers.id","=","orders.customer_id")
        ->join("product_orders","orders.id","=","product_orders.order_id")
        ->select("product_id")
        ->pluck("product_id");


         $suppliers = Product::whereIn("products.id",$productIds)
        ->join("suppliers","products.supplier_id","=","suppliers.id")
        ->select("first_name","last_name","name")
        ->get();


        return view('stores.suppliers_products', compact('suppliers'));
    }

    public function  products_same_stores()
    {
         $storeIds = Supplier::where("suppliers.first_name","Scottie")
        ->where("suppliers.last_name","crona")
        ->join("products","suppliers.id","=","products.supplier_id")
        ->join("stocks","stocks.product_id","=","products.id")
        ->join("stores","stores.id","=","stocks.store_id")
        ->distinct()
        ->pluck("stores.id");



        $products = Store::whereIn("stores.id",$storeIds)
        ->join("stocks","stocks.store_id","=","stores.id")
        ->join("products","products.id","=","stocks.product_id")
        ->select("products.id", "products.name")
        ->get();


        return view('stores.products_same_stores', compact('products'));
    }

    public function  countbystore()
    {
          $stores = Store::join("stocks","stocks.store_id","=","stores.id")
        ->groupBy("stores.id", "stores.name")
        ->selectRaw('stores.id as store_id, stores.name as store_name, count("product_id") as nbProducts' )
        ->get();

        return view('stores.countbystore', compact('stores'));
    }

public function storeValue()
{
    $stores = Store::join("stocks", "stocks.store_id", "=", "stores.id")
        ->join('products', 'stocks.product_id', '=', 'products.id')
        ->groupBy('stores.id', 'stores.name')
        ->selectRaw('stores.id as store_id, stores.name as store_name, SUM(products.price * stocks.quantity) as totalV')
        ->get();

    return view('stores.storeValue', compact('stores'));
}


    public function  storeGreater_than_lind()
    {
        $value = Store::where('stores.name','Lind-Gislason')
        ->join("stocks","stocks.store_id","=","stores.id")
        ->join('products','stocks.product_id','products.id')
        ->selectRaw('stores.id as store_id, stores.name as store_name, SUM(price * stocks.quantity_stock) as totalV' )
        ->groupBy('stores.id','stores.name')
        ->value("totalV");


        $stores = Store::join("stocks","stocks.store_id","=","stores.id")
        ->join('products','stocks.product_id','products.id')
        ->selectRaw('stores.id as store_id, stores.name as store_name, SUM(price * stocks.quantity_stock) as totalV' )
        ->groupBy('stores.id','stores.name')
        ->having('totalV','>', $value)
        ->get();


        return view('stores.storeGreater_than_lind', compact('stores', 'value'));
    }

}