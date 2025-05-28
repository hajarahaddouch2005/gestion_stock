<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'order_date',
        'customer_id'
    ];

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }

    public function product() : BelongsToMany {
        return $this->belongsToMany(Product::class,'product_orders')
        ->withTimestamps()
        ->withPivot('price','quantity');
    }
}
