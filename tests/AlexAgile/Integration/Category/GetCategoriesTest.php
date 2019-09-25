<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Category;

use AlexAgile\Domain\Category\GetCategoriesCommand;
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

        $this->assertCount(1, $categoriesArray);
    }
}
