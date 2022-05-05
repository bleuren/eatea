<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemSub extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_item_id',
        'received_at',
        'qty',
    ];

    protected $dates = [
        'received_at',
    ];

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}
