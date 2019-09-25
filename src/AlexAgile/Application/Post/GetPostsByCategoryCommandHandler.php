<?php
declare(strict_types=1);

namespace AlexAgile\Application\Post;

use AlexAgile\Domain\Category\GetCategoryService;
use AlexAgile\Domain\Post\GetPostsByCategoryCommand;
use AlexAgile\Domain\Post\GetPostsByCategoryService;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\ValueObject\UrlSlug;

class GetPostsByCategoryCommandHandler
{
    /** @var GetPostsByCategoryService */
    private $getPostsByCategoryService;

    /** @var GetCategoryService */
    private $getCategoryService;

    public function __construct(GetPostsByCategoryService $getPostsByCategoryService, GetCategoryService $getCategoryService)
    {
        $this->getPostsByCategoryService = $getPostsByCategoryService;
        $this->getCategoryService = $getCategoryService;
    }

    /**
     * @return Post[]
     */
    public function handle(GetPostsByCategoryCommand $command): array
    {
        $categoryUrlSlug = UrlSlug::create($command->categorUrlSlug());

        $category = $this->getCategoryService->execute([
            GetCategoryService::CATEGORY_URL_SLUG_KEY => $categoryUrlSlug,
        ]);

        return $this->getPostsByCategoryService->execute([
            GetPostsByCategoryService::CATEGORY_KEY => $category
        ]);
    }
}
