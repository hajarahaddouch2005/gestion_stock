<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        //كيتأكد من صحة البيانات (validation) عبر ProductRequest
        $validated = $request->validated();
        //إذا كان فيه ملف صورة (picture)، كيرفعها ويخزن المسار في الداتا.
        // Handle file upload if present
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('products', 'public');
            $validated['picture'] = $picturePath;
        }
        //كيخلق منتج جديد فقاعدة البيانات.
        $product = Product::create($validated);
        //ذا الطلب جاء عبر AJAX (واجهة برمجة التطبيقات)، يرجع JSON فيه نجاح والمنتج.

        //وإلا، يرجع Redirect مع رسالة نجاح.


        if ($request->ajax()) {
            return response()->json(['success' => true, 'product' => $product]);
        }

        return redirect()->route('products')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    //كيرجع تفاصيل المنتج على شكل JSON.

    //كيعتمد على Route Model Binding، يعني تلقائياً كيجيب المنتج حسب الـID من الرابط.

    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated(); //كيتأكد من صحة البيانات

        // Handle file upload if present
        if ($request->hasFile('picture')) { //إذا فيه ملف صورة جديدة:
            // Delete old picture if exists
            if ($product->picture) { //كيمسح الصورة القديمة (لو كانت موجودة)
                Storage::disk('public')->delete($product->picture);
            }
            //disk: 'public' يعني كيتخزن في المجلد public/storage/products

            $picturePath = $request->file('picture')->store('products', 'public');
            $validated['picture'] = $picturePath; //كيتخزن المسار الجديد للصورة في الداتا.
        }

        $product->update($validated);

        if ($request->ajax()) { //كيرجع JSON لو AJAX، أو Redirect مع رسالة نجاح.
            return response()->json(['success' => true, 'product' => $product]); //كيعطي نجاح والمنتج المحدث.
        }

        return redirect()->route('products')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    //كيمسح المنتج من قاعدة البيانات، وكيمسح الصورة المرتبطة به إذا كانت موجودة.
    public function destroy(Product $product)
    {
        // Delete product image if exists
        if ($product->picture) {
            Storage::disk('public')->delete($product->picture); // كيمسح الصورة من المجلد public/storage/products
        }
        Stock::where('product_id', $product->id)->delete();
        $product->delete();

        return response()->json(['success' => true]);
    }
    //يجلب جميع التصنيفات (Category).
    public function byCategory()
    {
        $categories = Category::all();
        $products = collect();

        return view('products.byCategory', compact('categories', 'products'));
    }
    //كيجيب المنتجات المرتبطة بتصنيف معين (Category)، مع معلومات المورد والمخزون.
    public function byCategoryX(Category $category)
    {
        $categories = Category::all();
        $products = $category->products()
            ->with(['supplier', 'stock'])
            ->get();
        // dd($products);
        return view('products.byCategory', compact('categories', 'products'));
    }
    //كيجيب المنتجات اللي تم طلبها خلال فبراير 2017.
    public function orderedProducts()
    {
        $orders = Order::join('product_orders', 'product_orders.order_id', '=', 'orders.id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->whereYear('orders.order_date', 2017)
            ->whereMonth('orders.order_date', 2)
            ->orderBy(DB::raw("CONCAT(customers.first_name, ' ', customers.last_name)"), "desc")
            ->select([
                'products.name as product_name',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                'categories.name as category_name',
                DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier_name"),
                'orders.order_date as order_date',
            ])
            ->get();

        return view('products.orderedProducts', compact('orders'));
    }
    //كيجلب أسماء المنتجات مع عدد الطلبات ديال كل منتج.
    public function ordersCount()
    {
        $products = Product::select('products.name')
            ->leftJoin('product_orders', 'products.id', '=', 'product_orders.product_id')
            ->groupBy('products.id', 'products.name')
            ->selectRaw('products.name, COUNT(product_orders.order_id) as orders_count')
            ->get();
        return view('products.ordersCount', compact('products'));
    }

    /**
     * Display products with more than 6 orders.
     */
    //كيجيب المنتجات اللي عدد الطلبات ديالها أكثر من 6.
    public function productsMoreThan6Orders()
    {
        $products = Product::select('products.id', 'products.name')
            ->leftJoin('product_orders', 'products.id', '=', 'product_orders.product_id')
            ->groupBy('products.id', 'products.name')
            ->selectRaw('products.name, COUNT(product_orders.order_id) as orders_count')
            ->havingRaw('COUNT(product_orders.order_id) > 6')
            ->get();
        return view('products.products_more_than_6_orders', compact('products'));
    }



    public function search(Request $request)
    {
        //كيدير بحث في جدول المنتجات على اسم المنتج أو الوصف باستخدام LIKE.
        $query = $request->input('query');
        $products = Product::with(['category', 'supplier', 'stock'])
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($products);
    }
}
