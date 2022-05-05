<?php

namespace App\Contracts;

interface IBaseService
{
    public function index();

    public function find($id);

    public function create($request);

    public function update($request, $id);

    public function delete($id);
}
