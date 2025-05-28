<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    /** @use HasFactory<\Database\Factories\StockFactory> */
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
        'store_id'
    ];

    public function products() : BelongsTo{
        return $this->belongsTo(Product::class);
    }

    public function stores() : BelongsTo {
        return $this->belongsTo(Store::class);
    }
}
