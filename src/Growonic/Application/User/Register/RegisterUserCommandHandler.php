<?php
declare(strict_types=1);

namespace Growonic\Application\User\Register;

use Growonic\Domain\User\Register\RegisterUserCommand;
use Growonic\Domain\User\Register\RegisterUserService;
use Growonic\Domain\User\Register\UserAlreadyExistsException;
use Growonic\Domain\User\User;
use Growonic\Domain\ValueObject\Email;
use Growonic\Domain\ValueObject\Password;
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
