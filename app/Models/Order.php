<?php

namespace App\Models;

use App\Models\Map;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'map_id',
        'address',
        'mobile',
        'payment',
        'message',
        'fee',
        'status',
    ];

    protected $casts = [
        'payment' => 'array',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['qty', 'discount']);
    }

}
