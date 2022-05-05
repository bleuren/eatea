<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository
{
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function index()
    {
        return $this->page->where('enabled', true)->orderBy('order', 'asc')->get();
    }
    public function create($request)
    {
        return $this->page->create($request);
    }
    public function findBySlug($slug)
    {
        $page = $this->page->where(['slug' => $slug, 'status' => 'ACTIVE'])->first();
        return $page;
    }

    public function update($slug, $request)
    {

    }

    public function delete($slug)
    {

    }
}
