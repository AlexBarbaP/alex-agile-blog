<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\User\Register;

use AlexAgile\Application\User\Register\UserRegisteredEventListener;
use AlexAgile\Domain\User\Register\RegisterUserService;
use AlexAgile\Domain\User\User;
use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Password;
use AlexAgile\Infrastructure\Messaging\EventBus\InMemory\InMemoryEventBus;
use AlexAgile\Infrastructure\Persistence\InMemory\User\UserRepositoryInMemoryAdapter;
use League\Event\EmitterInterface;
use PHPUnit\Framework\TestCase;

class RegisterUserServiceTest extends TestCase
{
    private const EVENT_USER_REGISTERED = 'Event.User.Registered';
    private const VALID_EMAIL = 'valid@email.com';
    private const VALID_PASSWORD = 'password-long-enough';

    /**
     * @test
     */
    public function registerUser_whenDataIsValid_shouldAddANewUserToStorage(): void
    {
        $user = new User(
            Email::create(self::VALID_EMAIL),
            Password::create(self::VALID_PASSWORD)
        );

        $userRepository = new UserRepositoryInMemoryAdapter([]);
        $inMemoryEventBus = new InMemoryEventBus();
        $registerUserService = new RegisterUserService($userRepository, $inMemoryEventBus);

        $registerUserService->execute([
            RegisterUserService::USER_KEY => $user
        ]);

        $this->assertCount(1, $userRepository->findAll());
    }

    /**
     * @test
     */
    public function registerUser_whenUserIsRegistered_shouldEmitAUserRegisteredEvent(): void
    {
        $user = new User(
            Email::create(self::VALID_EMAIL),
            Password::create(self::VALID_PASSWORD)
        );

        $inMemoryEventBus = $this->getInMemoryEventBus();

        $userRepository = new UserRepositoryInMemoryAdapter([]);
        $registerUserService = new RegisterUserService($userRepository, $inMemoryEventBus);

        $registerUserService->execute([
            RegisterUserService::USER_KEY => $user
        ]);
    }

    /**
     * @test
     * @expectedException \AlexAgile\Domain\User\Register\UserAlreadyExistsException
     */
    public function registerUser_whenUserAlreadyExists_shouldThrowAnException(): void
    {
        $user = new User(
            Email::create(self::VALID_EMAIL),
            Password::create(self::VALID_PASSWORD)
        );

        $userRepository = new UserRepositoryInMemoryAdapter([]);
        $inMemoryEventBus = new InMemoryEventBus();
        $registerUserService = new RegisterUserService($userRepository, $inMemoryEventBus);

        $registerUserService->execute([
            RegisterUserService::USER_KEY => $user
        ]);
        $registerUserService->execute([
            RegisterUserService::USER_KEY => $user
        ]);
    }

    private function getInMemoryEventBus(): EmitterInterface
    {
        $inMemoryEventBus = new InMemoryEventBus();

        $mockUserRegisteredEventListener = $this->getMockBuilder(UserRegisteredEventListener::class)
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $mockUserRegisteredEventListener->expects($this->once())
            ->method('handle');

        $inMemoryEventBus->addListener(self::EVENT_USER_REGISTERED, $mockUserRegisteredEventListener);

        return $inMemoryEventBus;
    }
}
