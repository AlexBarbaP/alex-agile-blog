<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\GetHomepagePostsCommand;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Tests\Integration\IntegrationTestAbstract;

class GetHomepagePostsTest extends IntegrationTestAbstract
{
    /**
     * @test
     */
    public function getHomepagePosts_whenPostsExists_shouldReturnAPostArray(): void
    {
        $getHomepagePostsCommand = new GetHomepagePostsCommand();
        $postArray = $this->commandBus->handle($getHomepagePostsCommand);

        $this->assertCount(1, $postArray);

        /** @var Post $firstPost */
        $firstPost = array_shift($postArray);
        $this->assertInstanceOf(Post::class, $firstPost);
        $this->assertInstanceOf(Category::class, $firstPost->getCategories()->first());
    }
}
