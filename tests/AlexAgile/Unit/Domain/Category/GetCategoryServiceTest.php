<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\GetCategoryService;
use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use AlexAgile\Infrastructure\Persistence\InMemory\Category\CategoryRepositoryInMemoryAdapter;
use PHPUnit\Framework\TestCase;

class GetCategoryServiceTest extends TestCase
{
    private const VALID_CATEGORY_COLOR = 'yellow';
    private const VALID_CATEGORY_TITLE = 'category-title';
    private const VALID_CATEGORY_URL_SLUG = 'category';

    /**
     * @test
     */
    public function findCategoryByUrlSlug_whenCategoryExist_shouldReturnACategory(): void
    {
        $category = new Category(
            Color::create(self::VALID_CATEGORY_COLOR),
            Title::create(self::VALID_CATEGORY_TITLE),
            UrlSlug::create(self::VALID_CATEGORY_URL_SLUG)
        );

        $categoryRepository = new CategoryRepositoryInMemoryAdapter([$category]);
        $getCategoryService = new GetCategoryService($categoryRepository);

        $categoryFound = $getCategoryService->execute([
            GetCategoryService::CATEGORY_URL_SLUG_KEY => $category->getUrlSlug(),
        ]);

        $this->assertInstanceOf(Category::class, $categoryFound);
    }

    /**
     * @test
     * @expectedException \AlexAgile\Domain\Category\CategoryNotFoundException
     */
    public function findCategoryByUrlSlug_whenCategoryNotExist_shouldThrowAnException(): void
    {
        $categoryRepository = new CategoryRepositoryInMemoryAdapter([]);
        $getCategoryService = new GetCategoryService($categoryRepository);

        $getCategoryService->execute([
            GetCategoryService::CATEGORY_URL_SLUG_KEY => UrlSlug::create(self::VALID_CATEGORY_URL_SLUG),
        ]);
    }
}
