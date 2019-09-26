<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\GetCategoriesService;
use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Order;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use AlexAgile\Infrastructure\Persistence\InMemory\Category\CategoryRepositoryInMemoryAdapter;
use PHPUnit\Framework\TestCase;

class GetCategoriesServiceTest extends TestCase
{
    private const CATEGORY_1_COLOR = 'yellow';
    private const CATEGORY_1_ORDER = 1;
    private const CATEGORY_1_TITLE = 'first-category-title';
    private const CATEGORY_1_URL_SLUG = 'category-one';

    private const CATEGORY_2_COLOR = 'blue';
    private const CATEGORY_2_ORDER = 2;
    private const CATEGORY_2_TITLE = 'second-category-title';
    private const CATEGORY_2_URL_SLUG = 'category-two';

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
     * @test
     */
    public function findAllCategoriesOrderedByOrder_whenCategoriesExist_shouldReturnAnOrderedCategoryArray(): void
    {
        $categoryRepository = new CategoryRepositoryInMemoryAdapter(
            $this->getCategoriesCollection()
        );
        $getCategoriesService = new GetCategoriesService($categoryRepository);

        $categories = $getCategoriesService->execute();

        $this->assertCount(2, $categories);

        /** @var Category $firstCategory */
        $firstCategory = array_shift($categories);
        /** @var Category $firstCategory */
        $secondCategory = array_shift($categories);

        $this->assertEquals(self::CATEGORY_1_TITLE, $firstCategory->getTitle()->title());
        $this->assertEquals(self::CATEGORY_2_TITLE, $secondCategory->getTitle()->title());
    }

    /**
     * @return Category[]
     */
    private function getCategoriesCollection(): array
    {
        return [
            new Category(
                Color::create(self::CATEGORY_1_COLOR),
                Order::create(self::CATEGORY_1_ORDER),
                Title::create(self::CATEGORY_1_TITLE),
                UrlSlug::create(self::CATEGORY_1_URL_SLUG)
            ),
            new Category(
                Color::create(self::CATEGORY_2_COLOR),
                Order::create(self::CATEGORY_2_ORDER),
                Title::create(self::CATEGORY_2_TITLE),
                UrlSlug::create(self::CATEGORY_2_URL_SLUG)
            )
        ];
    }
}
