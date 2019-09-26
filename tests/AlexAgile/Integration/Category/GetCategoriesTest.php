<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\GetCategoriesCommand;
use AlexAgile\Tests\Integration\Fixture\Category\DoctrineCategoryFixtureLoader;
use AlexAgile\Tests\Integration\IntegrationTestAbstract;

class GetCategoriesTest extends IntegrationTestAbstract
{
    /**
     * @test
     */
    public function getCategories_whenCategoriesExists_shouldReturnACategoriesArray(): void
    {
        $getCategoriesCommand = new GetCategoriesCommand();
        $categoriesArray = $this->commandBus->handle($getCategoriesCommand);

        $this->assertCount(2, $categoriesArray);
    }

    /**
     * @test
     */
    public function getCategories_whenCategoriesExists_shouldReturnAnOrderedCategoriesArray(): void
    {
        $getCategoriesCommand = new GetCategoriesCommand();
        $categoriesArray = $this->commandBus->handle($getCategoriesCommand);

        $this->assertCount(2, $categoriesArray);

        /** @var Category $firstCategory */
        $firstCategory = array_shift($categoriesArray);
        /** @var Category $firstCategory */
        $secondCategory = array_shift($categoriesArray);

        $this->assertEquals(DoctrineCategoryFixtureLoader::CATEGORY_1_TITLE, $firstCategory->getTitle()->title());
        $this->assertEquals(DoctrineCategoryFixtureLoader::CATEGORY_2_TITLE, $secondCategory->getTitle()->title());
    }
}
