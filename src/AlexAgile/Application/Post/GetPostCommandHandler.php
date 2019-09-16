<?php
declare(strict_types=1);

namespace AlexAgile\Application\Post;

use AlexAgile\Domain\Post\GetPostCommand;
use AlexAgile\Domain\Post\GetPostService;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\Post\PostNotFoundException;
use AlexAgile\Domain\ValueObject\UrlSlug;

class GetPostCommandHandler
{
    /** @var GetPostService */
    private $getPostService;

    public function __construct(GetPostService $getPostService)
    {
        $this->getPostService = $getPostService;
    }

    /**
     * @throws PostNotFoundException
     */
    public function handle(GetPostCommand $command): Post
    {
        $urlSlug = UrlSlug::create($command->urlSlug());

        return $this->getPostService->execute([
            GetPostService::POST_URL_SLUG_KEY => $urlSlug
        ]);
    }
}
