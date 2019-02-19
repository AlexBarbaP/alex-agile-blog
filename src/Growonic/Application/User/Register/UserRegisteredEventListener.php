<?php
declare(strict_types=1);

namespace Growonic\Application\User\Register;

use Growonic\Domain\User\UserRepositoryInterface;
use League\Event\EventInterface;
use League\Event\ListenerInterface;

class UserRegisteredEventListener implements ListenerInterface
{
    /** @var \Growonic\Domain\User\UserRepositoryInterface */
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
