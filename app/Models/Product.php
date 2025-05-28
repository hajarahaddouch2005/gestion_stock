<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'picture',
        'supplier_id',
        'category_id'
    ];

    public function supplier() : BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function orders() : BelongsToMany {
        return $this->belongsToMany(Order::class,'product_orders')
        ->withTimestamps()
        ->withPivot('price','quantity');
    }

    public function  stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }
}
