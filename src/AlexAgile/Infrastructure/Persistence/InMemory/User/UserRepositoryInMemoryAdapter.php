<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\InMemory\User;

use AlexAgile\Domain\User\User;
use AlexAgile\Domain\User\UserRepositoryInterface;
use AlexAgile\Domain\ValueObject\Email;

final class UserRepositoryInMemoryAdapter implements UserRepositoryInterface
{
    /** @var array */
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = array_reduce($data, function ($carry, User $user) {
            $carry[$user->getEmail()->email()] = clone $user;

            return $carry;
        }, []);
    }

    public function find(Email $email):? User
    {
        if (!array_key_exists($email->email(), $this->data)) {
            return null;
        }

        return clone $this->data[$email->email()];
    }

    public function findAll(): array
    {
        return array_map(function (User $user) {
            return clone $user;
        }, $this->data);
    }

    public function save(User $user): void
    {
        $this->data[$user->getEmail()->email()] = clone $user;
    }
}
