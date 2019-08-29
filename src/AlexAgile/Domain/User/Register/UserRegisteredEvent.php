<?php
declare(strict_types=1);

namespace AlexAgile\Domain\User\Register;

use AlexAgile\Domain\Event\EventAbstract;
use AlexAgile\Domain\User\UserId;

final class UserRegisteredEvent extends EventAbstract
{
    /** @var UserId */
    private $userId;

    public function __construct(string $id, UserId $userId)
    {
        parent::__construct($id);

        $this->userId = $userId;
    }

    public function getName(): string
    {
        return 'Event.User.Registered';
    }

    public function userId(): UserId
    {
        return $this->userId;
    }
}
