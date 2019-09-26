<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\GetHomepagePostsService;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Content;
use AlexAgile\Domain\ValueObject\Description;
use AlexAgile\Domain\ValueObject\ImageUrl;
use AlexAgile\Domain\ValueObject\Order;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use AlexAgile\Infrastructure\Persistence\InMemory\Post\PostRepositoryInMemoryAdapter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class GetHomepagePostsServiceTest extends TestCase
{
    private const VALID_CATEGORY_COLOR = 'yellow';
    private const VALID_CATEGORY_ORDER = 1;
    private const VALID_CATEGORY_TITLE = 'category-title';
    private const VALID_CATEGORY_URL_SLUG = 'category';
    private const VALID_CONTENT = 'Post Content';
    private const VALID_DESCRIPTION = 'Post Description';
    private const POST_ENABLED = true;
    private const POST_DISABLED = false;
    private const POST_HOMEPAGE_ENABLED = true;
    private const POST_HOMEPAGE_DISABLED = false;
    private const POST_IMAGE = '/folder/image.jpg';
    private const VALID_ORDER = 1;
    private const VALID_TITLE = 'Post title';
    private const VALID_URL_SLUG = 'post-slug';

    /**
     * @test
     */
    public function findHomepagePosts_whenPostsExist_shouldReturnAPostArray(): void
    {
        $postArray = $this->getPostArray($this->getCategoriesCollection());

        $postRepository = new PostRepositoryInMemoryAdapter($postArray);
        $getHomepagePostsService = new GetHomepagePostsService($postRepository);

        /** @var array $postsArray */
        $postsArray = $getHomepagePostsService->execute();

        $this->assertCount(1, $postsArray);

        /** @var Post $firstPost */
        $firstPost = array_shift($postsArray);
        $this->assertInstanceOf(Post::class, $firstPost);
        $this->assertInstanceOf(Category::class, $firstPost->getCategories()->first());
    }

    private function getCategoriesCollection(): Collection
    {
        return new ArrayCollection([
            new Category(
                Color::create(self::VALID_CATEGORY_COLOR),
                Order::create(self::VALID_CATEGORY_ORDER),
                Title::create(self::VALID_CATEGORY_TITLE),
                UrlSlug::create(self::VALID_CATEGORY_URL_SLUG)
            ),
            new Category(
                Color::create(self::VALID_CATEGORY_COLOR),
                Order::create(self::VALID_CATEGORY_ORDER),
                Title::create(self::VALID_CATEGORY_TITLE),
                UrlSlug::create(self::VALID_CATEGORY_URL_SLUG)
            )
        ]);
    }

    private function getPostArray(Collection $categoriesCollection): array
    {
        return [
            new Post(
                $categoriesCollection,
                Content::create(self::VALID_CONTENT),
                Description::create(self::VALID_DESCRIPTION),
                self::POST_ENABLED,
                self::POST_HOMEPAGE_ENABLED,
                ImageUrl::create(self::POST_IMAGE),
                Order::create(self::VALID_ORDER),
                Title::create(self::VALID_TITLE),
                UrlSlug::create(self::VALID_URL_SLUG)
            ),
            new Post(
                $categoriesCollection,
                Content::create(self::VALID_CONTENT),
                Description::create(self::VALID_DESCRIPTION),
                self::POST_ENABLED,
                self::POST_HOMEPAGE_DISABLED,
                ImageUrl::create(self::POST_IMAGE),
                Order::create(self::VALID_ORDER),
                Title::create(self::VALID_TITLE),
                UrlSlug::create(self::VALID_URL_SLUG)
            ),
            new Post(
                $categoriesCollection,
                Content::create(self::VALID_CONTENT),
                Description::create(self::VALID_DESCRIPTION),
                self::POST_DISABLED,
                self::POST_HOMEPAGE_ENABLED,
                ImageUrl::create(self::POST_IMAGE),
                Order::create(self::VALID_ORDER),
                Title::create(self::VALID_TITLE),
                UrlSlug::create(self::VALID_URL_SLUG)
            ),
        ];
    }
}
