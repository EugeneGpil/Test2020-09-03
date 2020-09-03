<?php

namespace App\Services\User\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * find single user by id
     * @param int $id
     * @return User|null
     */
    public function find(int $id) :?User;
}