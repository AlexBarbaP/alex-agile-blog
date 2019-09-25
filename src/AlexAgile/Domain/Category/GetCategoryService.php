<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Category;

use AlexAgile\Domain\ValueObject\UrlSlug;

class GetCategoryService
{
    public const CATEGORY_URL_SLUG_KEY = 'url-slug';

    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function execute(array $options = []): Category
    {
        /** @var UrlSlug $categorySlug */
        $categorySlug = $options[self::CATEGORY_URL_SLUG_KEY];

        if (!$category = $this->categoryRepository->findByUrlSlug($categorySlug)) {
            throw new CategoryNotFoundException('Category not found');
        }

        return $category;
    }
}
