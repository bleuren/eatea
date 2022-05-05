<?php
namespace App\Services;

use App\Contracts\IUserService;
use App\Repositories\UserRepository;

class UserService implements IUserService
{
    private $userRepo;

    public function __construct(
        UserRepository $userRepo,
    ) {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return $this->userRepo->index();
    }

    public function find($id)
    {
        return $this->userRepo->get($id);
    }

    public function findReferrer($id)
    {
        return $this->userRepo->findReferrer($id);
    }

    public function getReferrals($id)
    {
        return $this->userRepo->getReferrals($id);
    }

    public function create($request)
    {
        return $this->userRepo->create($request);
    }

    public function update($id, $request)
    {
        return $this->userRepo->update($id, $request);
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }

}
