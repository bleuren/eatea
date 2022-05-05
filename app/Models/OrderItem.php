<?php

namespace App\Models;

use App\Models\Order;
use App\Models\OrderItemSub;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'mode',
        'price',
        'qty',
        'discount',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderItemSubs()
    {
        return $this->hasMany(OrderItemSub::class);
    }
}
