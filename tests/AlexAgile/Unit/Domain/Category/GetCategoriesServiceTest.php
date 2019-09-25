<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\GetCategoriesService;
use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use AlexAgile\Infrastructure\Persistence\InMemory\Category\CategoryRepositoryInMemoryAdapter;
use PHPUnit\Framework\TestCase;

class GetCategoriesServiceTest extends TestCase
{
    private const CATEGORY_COLOR = 'yellow';
    private const CATEGORY_TITLE = 'category-title';
    private const CATEGORY_URL_SLUG1 = 'category-one';
    private const CATEGORY_URL_SLUG2 = 'category-two';

    /**
     * @test
     */
    public function findAllCategories_whenCategoriesExist_shouldReturnACategoryArray(): void
    {
        $categoryRepository = new CategoryRepositoryInMemoryAdapter(
            $this->getCategoriesCollection()
        );
        $getCategoriesService = new GetCategoriesService($categoryRepository);

        $categories = $getCategoriesService->execute();

        $this->assertCount(2, $categories);
    }

    /**
     * @return Category[]
     */
    private function getCategoriesCollection(): array
    {
        return [
            new Category(
                Color::create(self::CATEGORY_COLOR),
                Title::create(self::CATEGORY_TITLE),
                UrlSlug::create(self::CATEGORY_URL_SLUG1)
            ),
            new Category(
                Color::create(self::CATEGORY_COLOR),
                Title::create(self::CATEGORY_TITLE),
                UrlSlug::create(self::CATEGORY_URL_SLUG2)
            )
        ];
    }
}
