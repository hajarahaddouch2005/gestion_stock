<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //Affiche la vue orders.byCustomer
    public function index(){
        $customers = Customer::all();
        $orders = collect();
        return view('orders.byCustomer',compact('customers', 'orders'));
    }
//Retourne en JSON les commandes du client avec ses relations customer et product.

//Usage : AJAX ou API.
    public function getOrdersByCustomer($customerId){
        $orders = Order::with(['customer', 'product'])
                    ->where('customer_id', $customerId)
                    ->get();

        return response()->json($orders);
    }

   ///////
//Retourne les commandes d’un client
    public function index1(){
        return view('orders.bySearchCustomer');
    }
//
    public function getOrdersByCustomer1($customerId){
        $orders = Order::where('customer_id', $customerId)
                    ->get();
        return response()->json($orders);
    }
//Retourne en JSON les détails d’une commande avec les relations chargées (customer, product).
    public function getOrderDetails1($orderId){
        $order = Order::with(['customer', 'product'])
                    ->where('id', $orderId)
                    ->first();

        return response()->json($order);
    }

    public function index2(){
        return view('orders.bySearchCustomerView');
    }
//Affiche orders.bySearchCustomerView, probablement avec un formulaire de recherche.


    public function getOrdersByCustomer2($customerId){
        //Retourne une vue HTML (pas JSON) avec la liste des commandes du client : orders.ordersListView.
        $orders = Order::where('customer_id', $customerId)
                    ->get();
    return view('orders.ordersListView', compact('orders'));
    }

    public function getOrderDetails2($orderId){
        //Retourne une vue HTML des détails de la commande : orders.orderDetailsView.
        $order = Order::with(['customer', 'product'])
                    ->where('id', $orderId)
                    ->first();

        return view('orders.orderDetailsView', compact('order'));
    }

    public function orderTotals()
    {
        // Récupère les totaux des commandes avec les informations du client
        $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->select(
                'orders.id',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                'orders.order_date',
                DB::raw('SUM(product_orders.price * product_orders.quantity) as total_amount')
                )
            ->groupBy('orders.id', 'customers.first_name', 'customers.last_name', 'orders.order_date')
            ->orderBy('orders.id')
            ->get();
        return view('orders.order_totals', compact('orders'));
                }

    public function ordersGreaterThanOrder60()
    {
        // Récupère le total de la commande 60
        // et les commandes dont le total est supérieur à celui-ci
        $order60Total = DB::table('product_orders')
            ->where('order_id', 60)
            ->selectRaw('SUM(price * quantity)')
            ->value(DB::raw('SUM(price * quantity)'));

        $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->select(
                'orders.id',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                'orders.order_date',
                DB::raw('SUM(product_orders.price * product_orders.quantity) as total_amount')
            )
            ->groupBy('orders.id', 'customers.first_name', 'customers.last_name', 'orders.order_date')
            ->having('total_amount', '>', $order60Total)
            ->orderBy('orders.id')
            ->get();

        return view('orders.orders_greater_than_60', compact('orders', 'order60Total'));
    }
}
