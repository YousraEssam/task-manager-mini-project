<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Get admin users query.
     *
     * @return array
     */
    public function getAdminUsers(): array
    {
        return User::whereIsAdmin(true)->orderBy('name','asc')->pluck('name', 'id')->toArray();
    }

    /**
     * Get non-admin users query.

     * @return array
     */
    public function getNonAdminUsers(): array
    {
        return User::whereIsAdmin(false)->orderBy('name','asc')->pluck('name', 'id')->toArray();
    }
}
