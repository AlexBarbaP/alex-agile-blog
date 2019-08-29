<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\User\Register;

use AlexAgile\Domain\User\Register\RegisterUserCommand;
use AlexAgile\Tests\Integration\IntegrationTestAbstract;

class RegisterUserTest extends IntegrationTestAbstract
{
    private const VALID_EMAIL = 'new-valid@email.com';
    private const VALID_PASSWORD = 'password-long-enough';

    /**
     * @test
     */
    public function registerUser_whenDataIsValid_shouldAddANewUserToStorage(): void
    {
        $this->assertCount(1, $this->userRepositoryDoctrineAdapter->findAll());

        $registerUserCommand = new RegisterUserCommand(self::VALID_EMAIL, self::VALID_PASSWORD);
        $this->commandBus->handle($registerUserCommand);

        $this->assertCount(2, $this->userRepositoryDoctrineAdapter->findAll());
    }

    /**
     * @test
     * @expectedException \AlexAgile\Domain\User\Register\UserAlreadyExistsException
     */
    public function registerUser_whenUserAlreadyExists_shouldThrowAnException(): void
    {
        $registerUserCommand = new RegisterUserCommand(self::VALID_EMAIL, self::VALID_PASSWORD);
        $this->commandBus->handle($registerUserCommand);
        $this->commandBus->handle($registerUserCommand);
    }
}
