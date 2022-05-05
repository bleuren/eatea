<?php

namespace App\Models;

use App\Models\Order;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Product extends Model implements Buyable
{
    use HasFactory, Translatable;

    protected $translatable = ['name', 'body'];

    protected $fillable = [
        'name', 'slug', 'price', 'stock',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['qty', 'discount']); //綁定與Video的關係
    }
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
    public function getBuyableWeight($options = null)
    {
        return 0;
    }
}
