<?php
declare(strict_types=1);

namespace AlexAgile\Application\Post;

use AlexAgile\Domain\Post\GetHomepagePostsCommand;
use AlexAgile\Domain\Post\GetHomepagePostsService;
use AlexAgile\Domain\Post\Post;

class GetHomepagePostsCommandHandler
{
    /** @var GetHomepagePostsService */
    private $getHomepagePostsService;

    public function __construct(GetHomepagePostsService $getHomepagePostsService)
    {
        $this->getHomepagePostsService = $getHomepagePostsService;
    }

    /**
     * @return Post[]
     */
    public function handle(GetHomepagePostsCommand $command): array
    {
        return $this->getHomepagePostsService->execute();
    }
}
