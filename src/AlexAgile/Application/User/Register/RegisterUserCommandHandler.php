<?php
declare(strict_types=1);

namespace AlexAgile\Application\User\Register;

use AlexAgile\Domain\User\Register\RegisterUserCommand;
use AlexAgile\Domain\User\Register\RegisterUserService;
use AlexAgile\Domain\User\Register\UserAlreadyExistsException;
use AlexAgile\Domain\User\User;
use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Password;
use League\Event\EmitterInterface;

class RegisterUserCommandHandler
{
    /** @var RegisterUserService */
    private $registerUserService;

    /** @var EmitterInterface */
    private $emitter;

    public function __construct(
        RegisterUserService $registerUserService,
        EmitterInterface $emitter
    ) {
        $this->registerUserService = $registerUserService;
        $this->emitter = $emitter;
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function handle(RegisterUserCommand $command): void
    {
        $email = Email::create($command->email());
        $password = Password::create($command->password());

        $user = new User($email, $password);

        $this->registerUserService->execute([
            RegisterUserService::USER_KEY => $user
        ]);
    }
}
