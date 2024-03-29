<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Messaging\CommandBus\Tactician;

use AlexAgile\Application\Category\GetCategoriesCommandHandler;
use AlexAgile\Application\ContactRequest\CreateContactRequestCommandHandler;
use AlexAgile\Application\Post\GetHomepagePostsCommandHandler;
use AlexAgile\Application\Post\GetPostCommandHandler;
use AlexAgile\Application\Post\GetPostsByCategoryCommandHandler;
use AlexAgile\Domain\Category\GetCategoriesCommand;
use AlexAgile\Domain\Category\GetCategoriesService;
use AlexAgile\Domain\Category\GetCategoryService;
use AlexAgile\Domain\ContactRequest\CreateContactRequestCommand;
use AlexAgile\Domain\ContactRequest\CreateContactRequestService;
use AlexAgile\Domain\Post\GetHomepagePostsCommand;
use AlexAgile\Domain\Post\GetHomepagePostsService;
use AlexAgile\Domain\Post\GetPostCommand;
use AlexAgile\Domain\Post\GetPostsByCategoryCommand;
use AlexAgile\Domain\Post\GetPostsByCategoryService;
use AlexAgile\Domain\Post\GetPostService;
use League\Event\EmitterInterface;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

final class TacticianCommandBusFactory
{
    /** @var CommandBus */
    private $commandBus;

    /** @var EmitterInterface */
    private $eventBus;

    public function __construct(
        CreateContactRequestService $createContactRequestService,
        GetPostService $getPostService,
        GetHomepagePostsService $getHomepagePostsService,
        GetPostsByCategoryService $getPostsByCategoryService,
        GetCategoryService $getCategoryService,
        GetCategoriesService $getCategoriesService,
        EmitterInterface $eventBus
    ) {
        $this->eventBus = $eventBus;

        $nameExtractor = new ClassNameExtractor();

        $inflector = new HandleInflector();

        // register commands
        $createContactRequestCommandHandler = new CreateContactRequestCommandHandler($createContactRequestService);
        $getPostCommandHandler = new GetPostCommandHandler($getPostService);
        $getHomepagePostsCommandHandler = new GetHomepagePostsCommandHandler($getHomepagePostsService);
        $getPostsByCategoryCommandHandler = new GetPostsByCategoryCommandHandler($getPostsByCategoryService, $getCategoryService);
        $getCategoriesCommandHandler = new GetCategoriesCommandHandler($getCategoriesService);

        $locator = new InMemoryLocator();
        $locator->addHandler($createContactRequestCommandHandler, CreateContactRequestCommand::class);
        $locator->addHandler($getPostCommandHandler, GetPostCommand::class);
        $locator->addHandler($getHomepagePostsCommandHandler, GetHomepagePostsCommand::class);
        $locator->addHandler($getPostsByCategoryCommandHandler, GetPostsByCategoryCommand::class);
        $locator->addHandler($getCategoriesCommandHandler, GetCategoriesCommand::class);

        $commandHandlerMiddleware = new CommandHandlerMiddleware($nameExtractor, $locator, $inflector);

        $this->commandBus = new CommandBus([$commandHandlerMiddleware]);
    }

    /**
     * @return CommandBus
     */
    public function create(): CommandBus
    {
        return $this->commandBus;
    }
}
