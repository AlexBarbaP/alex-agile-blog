<?php
declare(strict_types=1);

namespace AlexAgile\Domain\User\Register;

use AlexAgile\Domain\User\User;
use AlexAgile\Domain\User\UserRepositoryInterface;
use League\Event\EmitterInterface;
use Ramsey\Uuid\Uuid;

class RegisterUserService
{
    public const USER_KEY = 'user';

    /** @var \AlexAgile\Domain\User\UserRepositoryInterface */
    private $userRepository;

    /** @var EmitterInterface */
    private $eventBus;

    public function __construct(UserRepositoryInterface $userRepository, EmitterInterface $eventBus)
    {
        $this->userRepository = $userRepository;
        $this->eventBus = $eventBus;
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function execute(array $options = []): void
    {
        /** @var User $user */
        $user = $options[self::USER_KEY];

        if ($this->userRepository->find($user->getEmail())) {
            throw new UserAlreadyExistsException('User already exists');
        }

        $this->userRepository->save($user);

        $this->eventBus->emit(new UserRegisteredEvent(
            Uuid::uuid4()->toString(),
            $user->getId()
        ));
    }
}
