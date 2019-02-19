<?php
declare(strict_types=1);

namespace Growonic\Tests\Integration;

use Growonic\Domain\User\Register\RegisterUserService;
use Growonic\Infrastructure\Messaging\CommandBus\Tactician\TacticianCommandBusFactory;
use Growonic\Infrastructure\Messaging\EventBus\League\LeagueEventBusFactory;
use Growonic\Infrastructure\Persistence\Doctrine\User\UserRepositoryDoctrineAdapter;
use Growonic\Tests\DoctrineAwareTestTrait;
use League\Event\EmitterInterface;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;

class IntegrationTestAbstract extends TestCase
{
    use DoctrineAwareTestTrait;

    /** @var UserRepositoryDoctrineAdapter */
    protected $userRepositoryDoctrineAdapter;

    /** @var RegisterUserService */
    protected $registerUserService;

    /** @var CommandBus */
    protected $commandBus;

    /** @var EmitterInterface */
    protected $eventBus;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpEntityManager();

        $this->fixturesLoader();

        $this->userRepositoryDoctrineAdapter = new UserRepositoryDoctrineAdapter($this->entityManager);

        $this->setupEventBus();

        $this->registerUserService = new RegisterUserService($this->userRepositoryDoctrineAdapter, $this->eventBus);

        $this->setupCommandBus();
    }

    private function setupEventBus(): void
    {
        $eventBusFactory = new LeagueEventBusFactory($this->userRepositoryDoctrineAdapter);

        $this->eventBus = $eventBusFactory->create();
    }

    private function setupCommandBus(): void
    {
        $commandBusFactory = new TacticianCommandBusFactory(
            $this->registerUserService,
            $this->eventBus
        );

        $this->commandBus = $commandBusFactory->create();
    }
}
