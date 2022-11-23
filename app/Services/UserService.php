<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;

class UserService
{
    /**
     * Get user list with roles
     *
     * @return mixed
     */
    public function getAllUsers(): mixed
    {
        return User::whereRole(UserRole::USER)->get();
    }
}
