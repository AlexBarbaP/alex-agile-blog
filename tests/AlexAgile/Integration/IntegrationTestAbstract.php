<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration;

use AlexAgile\Domain\Category\GetCategoriesService;
use AlexAgile\Domain\Category\GetCategoryService;
use AlexAgile\Domain\Post\GetHomepagePostsService;
use AlexAgile\Domain\Post\GetPostsByCategoryService;
use AlexAgile\Domain\Post\GetPostService;
use AlexAgile\Domain\User\Register\RegisterUserService;
use AlexAgile\Infrastructure\Messaging\CommandBus\Tactician\TacticianCommandBusFactory;
use AlexAgile\Infrastructure\Messaging\EventBus\League\LeagueEventBusFactory;
use AlexAgile\Infrastructure\Persistence\Doctrine\Category\CategoryRepositoryDoctrineAdapter;
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

    /** @var CategoryRepositoryDoctrineAdapter  */
    protected $categoryRepositoryDoctrineAdapter;

    /** @var RegisterUserService */
    protected $registerUserService;

    /** @var GetPostService */
    protected $getPostService;

    /** @var GetHomepagePostsService */
    protected $getHomepagePostsService;

    /** @var GetPostsByCategoryService */
    protected $getPostsByCategoryService;

    /** @var GetCategoryService */
    protected $getCategoryService;

    /** @var GetCategoriesService  */
    protected $getCategoriesService;

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
        $this->categoryRepositoryDoctrineAdapter = new CategoryRepositoryDoctrineAdapter($this->entityManager);

        $this->setupEventBus();

        $this->registerUserService = new RegisterUserService($this->userRepositoryDoctrineAdapter, $this->eventBus);
        $this->getPostService = new GetPostService($this->postRepositoryDoctrineAdapter);
        $this->getHomepagePostsService = new GetHomepagePostsService($this->postRepositoryDoctrineAdapter);
        $this->getPostsByCategoryService = new GetPostsByCategoryService($this->postRepositoryDoctrineAdapter);
        $this->getCategoryService = new GetCategoryService($this->categoryRepositoryDoctrineAdapter);
        $this->getCategoriesService = new GetCategoriesService($this->categoryRepositoryDoctrineAdapter);

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
            $this->getHomepagePostsService,
            $this->getPostsByCategoryService,
            $this->getCategoryService,
            $this->getCategoriesService,
            $this->eventBus
        );

        $this->commandBus = $commandBusFactory->create();
    }
}
