<?php
namespace App\Services;

use App\Contracts\ICartService;
use App\Repositories\CartRepository;

class CartService implements ICartService
{
    private $cartRepo;

    public function __construct(
        CartRepository $cartRepo,
    ) {
        $this->cartRepo = $cartRepo;
    }

    public function index()
    {
        return $this->cartRepo->index();
    }

    public function find($id)
    {
        return $this->cartRepo->get($id);
    }

    public function create($request)
    {
        return $this->cartRepo->create($request);
    }

    public function update($request, $id)
    {
        return $this->cartRepo->update($request, $id);
    }

    public function delete($id)
    {
        return $this->cartRepo->delete($id);
    }

}
