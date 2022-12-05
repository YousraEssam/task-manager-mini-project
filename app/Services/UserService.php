<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository $userRepo
     */
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Get users.
     * @return array
     */
    public function getUsers(): array
    {
        return [
            'adminUsers' => $this->getAdminUsers(),
            'nonAdminUsers' => $this->getNonAdminUsers()
        ];
    }

    /**
     * Get admin users.
     *
     * @return array
     */
    private function getAdminUsers(): array
    {
        return $this->userRepo->getAdminUsers();
    }

    /**
     * Get non-admin users.
     *
     * @return array
     */
    private function getNonAdminUsers(): array
    {
        return $this->userRepo->getNonAdminUsers();
    }
}
