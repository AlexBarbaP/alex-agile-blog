<?php
declare(strict_types=1);

namespace AlexAgile\Application\User\Register;

use AlexAgile\Domain\User\UserRepositoryInterface;
use League\Event\EventInterface;
use League\Event\ListenerInterface;

class UserRegisteredEventListener implements ListenerInterface
{
    /** @var \AlexAgile\Domain\User\UserRepositoryInterface */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(EventInterface $event): void
    {
        // TODO
    }

    /**
     * @inheritdoc
     */
    public function isListener($listener)
    {
        return $listener === $this;
    }
}
