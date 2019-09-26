<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\GetPostsByCategoryCommand;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Tests\Integration\Fixture\Category\DoctrineCategoryFixtureLoader;
use AlexAgile\Tests\Integration\IntegrationTestAbstract;

class GetPostsByCategoryTest extends IntegrationTestAbstract
{
    /**
     * @test
     */
    public function getPostsByCategory_whenPostsExists_shouldReturnAPostArray(): void
    {
        $getPostsByCategoryCommand = new GetPostsByCategoryCommand(DoctrineCategoryFixtureLoader::CATEGORY_URL_SLUG);
        $postArray = $this->commandBus->handle($getPostsByCategoryCommand);

        $this->assertCount(3, $postArray);

        /** @var Post $firstPost */
        $firstPost = array_shift($postArray);
        $this->assertInstanceOf(Post::class, $firstPost);
        $this->assertInstanceOf(Category::class, $firstPost->getCategories()->first());
    }
}
