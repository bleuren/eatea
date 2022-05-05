<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->get();
    }
    public function create($request)
    {
        return $this->user->create($request);
    }

    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    public function findByRole($role)
    {
        return $this->user->where(['role_id' => $role])->first();
    }

    public function findReferrer($id)
    {
        return $this->user->where(['affiliate_id' => $this->find($id)->referred_by])->first();
    }

    public function getReferrals($id)
    {
        return $this->user->where(['referred_by' => $this->find($id)->affiliate_id])->get();
    }

    public function update($slug, $request)
    {

    }

    public function delete($slug)
    {

    }
}
