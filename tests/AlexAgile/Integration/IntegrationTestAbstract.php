<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration;

use AlexAgile\Domain\Post\GetPostService;
use AlexAgile\Domain\User\Register\RegisterUserService;
use AlexAgile\Infrastructure\Messaging\CommandBus\Tactician\TacticianCommandBusFactory;
use AlexAgile\Infrastructure\Messaging\EventBus\League\LeagueEventBusFactory;
use AlexAgile\Infrastructure\Persistence\Doctrine\Post\PostRepositoryDoctrineAdapter;
use AlexAgile\Infrastructure\Persistence\Doctrine\User\UserRepositoryDoctrineAdapter;
use AlexAgile\Tests\DoctrineAwareTestTrait;
use League\Event\EmitterInterface;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;

class IntegrationTestAbstract extends TestCase
{
    use DoctrineAwareTestTrait;

    /** @var UserRepositoryDoctrineAdapter */
    protected $userRepositoryDoctrineAdapter;

    /** @var PostRepositoryDoctrineAdapter */
    protected $postRepositoryDoctrineAdapter;

    /** @var RegisterUserService */
    protected $registerUserService;

    /** @var GetPostService */
    protected $getPostService;

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
        $this->postRepositoryDoctrineAdapter = new PostRepositoryDoctrineAdapter($this->entityManager);

        $this->setupEventBus();

        $this->registerUserService = new RegisterUserService($this->userRepositoryDoctrineAdapter, $this->eventBus);
        $this->getPostService = new GetPostService($this->postRepositoryDoctrineAdapter);

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
            $this->getPostService,
            $this->eventBus
        );

        $this->commandBus = $commandBusFactory->create();
    }
}
