<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

use AlexAgile\Domain\Category\Category;

class GetPostsByCategoryService
{
    public const CATEGORY_KEY = 'category';

    /** @var PostRepositoryInterface */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return Post[]
     */
    public function execute(array $options = []): array
    {
        /** @var Category $category */
        $category = $options[self::CATEGORY_KEY];

        return $this->postRepository->findAllEnabledByCategoryOrderedByOrder($category);
    }
}
