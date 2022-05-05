<?php

namespace App\Repositories;

use App\Models\Map;

class MapRepository
{
    private $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function index()
    {
        return $this->map->get();
    }
    public function create($request)
    {
        return $this->map->create($request);
    }

    public function find($id)
    {
        return $this->map->findOrFail($id);
    }

    public function findByAddress($city, $district, $road)
    {
        return $this->map->where(['city' => $city, 'district' => $district, 'road' => $road])->first();
    }

    public function update($slug, $request)
    {

    }

    public function delete($slug)
    {

    }
}
