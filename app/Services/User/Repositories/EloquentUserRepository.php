<?php

namespace App\Services\User\Repositories;

use App\Services\User\Repositories\UserRepositoryInterface;
use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * find single user by id
     * @param int $id
     * @return User|null
     */
    public function find(int $id) :?User
    {
        return User::find($id);
    }
}