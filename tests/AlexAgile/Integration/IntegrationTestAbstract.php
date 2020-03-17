<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration;

use AlexAgile\Domain\Category\GetCategoriesService;
use AlexAgile\Domain\Category\GetCategoryService;
use AlexAgile\Domain\ContactRequest\CreateContactRequestService;
use AlexAgile\Domain\Notification\NotificationServiceInterface;
use AlexAgile\Domain\Post\GetHomepagePostsService;
use AlexAgile\Domain\Post\GetPostsByCategoryService;
use AlexAgile\Domain\Post\GetPostService;
use AlexAgile\Infrastructure\Messaging\CommandBus\Tactician\TacticianCommandBusFactory;
use AlexAgile\Infrastructure\Messaging\EventBus\League\LeagueEventBusFactory;
use AlexAgile\Infrastructure\Notification\Swiftmailer\NotificationServiceSwiftmailerAdapter;
use AlexAgile\Infrastructure\Persistence\Doctrine\Category\CategoryRepositoryDoctrineAdapter;
use AlexAgile\Infrastructure\Persistence\Doctrine\ContactRequest\ContactRequestRepositoryDoctrineAdapter;
use AlexAgile\Infrastructure\Persistence\Doctrine\Post\PostRepositoryDoctrineAdapter;
use AlexAgile\Tests\DoctrineAwareTestTrait;
use League\Event\EmitterInterface;
use League\Tactician\CommandBus;
use PHPUnit\Framework\TestCase;

class IntegrationTestAbstract extends TestCase
{
    use DoctrineAwareTestTrait;

    /** @var ContactRequestRepositoryDoctrineAdapter */
    protected $contactRequestRepositoryDoctrineAdapter;

    /** @var PostRepositoryDoctrineAdapter */
    protected $postRepositoryDoctrineAdapter;

    /** @var CategoryRepositoryDoctrineAdapter  */
    protected $categoryRepositoryDoctrineAdapter;

    /** @var CreateContactRequestService */
    protected $createContactRequestService;

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

    /** @var NotificationServiceInterface */
    protected $notificationService;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpEntityManager();
        $this->setupNotificationService();

        $this->fixturesLoader();

        $this->contactRequestRepositoryDoctrineAdapter = new ContactRequestRepositoryDoctrineAdapter($this->entityManager);
        $this->postRepositoryDoctrineAdapter = new PostRepositoryDoctrineAdapter($this->entityManager);
        $this->categoryRepositoryDoctrineAdapter = new CategoryRepositoryDoctrineAdapter($this->entityManager);

        $this->setupEventBus();

        $this->createContactRequestService = new CreateContactRequestService($this->contactRequestRepositoryDoctrineAdapter, $this->eventBus);
        $this->getPostService = new GetPostService($this->postRepositoryDoctrineAdapter);
        $this->getHomepagePostsService = new GetHomepagePostsService($this->postRepositoryDoctrineAdapter);
        $this->getPostsByCategoryService = new GetPostsByCategoryService($this->postRepositoryDoctrineAdapter);
        $this->getCategoryService = new GetCategoryService($this->categoryRepositoryDoctrineAdapter);
        $this->getCategoriesService = new GetCategoriesService($this->categoryRepositoryDoctrineAdapter);

        $this->setupCommandBus();
    }

    private function setupEventBus(): void
    {
        $eventBusFactory = new LeagueEventBusFactory($this->contactRequestRepositoryDoctrineAdapter, $this->notificationService);

        $this->eventBus = $eventBusFactory->create();
    }

    private function setupCommandBus(): void
    {
        $commandBusFactory = new TacticianCommandBusFactory(
            $this->createContactRequestService,
            $this->getPostService,
            $this->getHomepagePostsService,
            $this->getPostsByCategoryService,
            $this->getCategoryService,
            $this->getCategoriesService,
            $this->eventBus
        );

        $this->commandBus = $commandBusFactory->create();
    }

    private function setupNotificationService(): void
    {
        $spool = new \Swift_MemorySpool();
        $transport = new \Swift_Transport_SpoolTransport(
            new \Swift_Events_SimpleEventDispatcher(),
            $spool
        );
        $mailer = new \Swift_Mailer($transport);

        $this->notificationService = new NotificationServiceSwiftmailerAdapter($mailer);
    }
}
