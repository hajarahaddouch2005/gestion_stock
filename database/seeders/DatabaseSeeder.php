<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $categories = [
        'Electronics',
        'Clothing',
        'Home Appliances',
        'Furniture',
        'Books',
        'Sports Equipment',
        'Toys',
        'Beauty & Personal Care',
        'Office Supplies',
        'Kitchen & Dining',
        'Automotive',
        'Garden & Outdoor',
        'Health & Wellness',
        'Pet Supplies',
        'Tools & Hardware'
    ];

    protected $numProductsPerOrder = [1, 2, 3, 4, 5];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        $categories = collect($this->categories)->map(function ($name) {
            return Category::create(['name' => $name]);
        });

        $suppliers = Supplier::factory(10)->create();
        $stores = Store::factory(5)->create();

        $products = Product::factory(50)
            ->recycle($suppliers)
            ->recycle($categories)
            ->create();

        Stock::factory(100)
            ->recycle($products)
            ->recycle($stores)
            ->create();

        $customers = Customer::factory(50)->create();
        $products = Product::all();

        Order::factory(100)->create()->each(function ($order) use ($products) {
            
            $numProducts = fake()->randomElement($this->numProductsPerOrder);

            $orderProducts = $products->random($numProducts);

            foreach ($orderProducts as $product) {
                $quantity = fake()->numberBetween(1, 5);
                $price = $product->price * $quantity;

                $order->product()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        });

        Transaction::factory(50)->create();
    }
}
