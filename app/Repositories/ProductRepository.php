<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return $this->product->where('enabled', true)->orderBy('order', 'asc')->get();
    }
    public function create($request)
    {
        return $this->product->create($request);
    }
    public function find($id)
    {
        $product = $this->product->find($id);
        return $product;
    }
    public function findBySlug($slug, $enabled = null)
    {
        $conditions = ['slug' => $slug];

        if (!is_null($enabled)) {
            $conditions['enabled'] = $enabled;
        }

        $product = $this->product->where($conditions)->first();
        return $product;
    }

    public function update($slug, $request)
    {
        $product = $this->findBySlug($slug);
        if (!$product) {
            return false;
        }
        return $product->update($request);
    }

    public function delete($slug)
    {
        $product = $this->findBySlug($slug);
        return $product ? $product->delete() : false;
    }
}
