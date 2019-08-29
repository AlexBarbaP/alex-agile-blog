<?php
declare(strict_types=1);

namespace AlexAgile\Domain\User;

use AlexAgile\Domain\ValueObject\Email;

interface UserRepositoryInterface
{
    public function find(Email $email):? User;

    /**
     * @return User[]
     */
    public function findAll(): array;

    public function save(User $user):void;
}
