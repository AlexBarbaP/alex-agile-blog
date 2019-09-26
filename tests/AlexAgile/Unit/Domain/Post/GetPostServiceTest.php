<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\GetPostService;
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
use PHPUnit\Framework\TestCase;

class GetPostServiceTest extends TestCase
{
    private const VALID_CATEGORY_COLOR = 'yellow';
    private const VALID_CATEGORY_ORDER = 1;
    private const VALID_CATEGORY_TITLE = 'category-title';
    private const VALID_CATEGORY_URL_SLUG = 'category';
    private const VALID_CONTENT = 'Post Content';
    private const VALID_DESCRIPTION = 'Post Description';
    private const POST_ENABLED = true;
    private const POST_HOMEPAGE = true;
    private const POST_IMAGE = '/folder/image.jpg';
    private const VALID_ORDER = 1;
    private const VALID_TITLE = 'Post title';
    private const VALID_URL_SLUG = 'post-slug';

    /**
     * @test
     */
    public function findPostByUrlSlug_whenPostExist_shouldReturnAPost(): void
    {
        $category = new Category(
            Color::create(self::VALID_CATEGORY_COLOR),
            Order::create(self::VALID_CATEGORY_ORDER),
            Title::create(self::VALID_CATEGORY_TITLE),
            UrlSlug::create(self::VALID_CATEGORY_URL_SLUG)
        );

        $post           = new Post(
            new ArrayCollection([$category]),
            Content::create(self::VALID_CONTENT),
            Description::create(self::VALID_DESCRIPTION),
            self::POST_ENABLED,
            self::POST_HOMEPAGE,
            ImageUrl::create(self::POST_IMAGE),
            Order::create(self::VALID_ORDER),
            Title::create(self::VALID_TITLE),
            UrlSlug::create(self::VALID_URL_SLUG)
        );

        $postRepository = new PostRepositoryInMemoryAdapter([$post]);
        $getPostService = new GetPostService($postRepository);

        $postFound = $getPostService->execute([
            GetPostService::POST_URL_SLUG_KEY => $post->getUrlSlug(),
        ]);

        $this->assertInstanceOf(Post::class, $postFound);
    }

    /**
     * @test
     * @expectedException \AlexAgile\Domain\Post\PostNotFoundException
     */
    public function findPostByUrlSlug_whenPostNotExist_shouldThrowAnException(): void
    {
        $postRepository = new PostRepositoryInMemoryAdapter([]);
        $getPostService = new GetPostService($postRepository);

        $getPostService->execute([
            GetPostService::POST_URL_SLUG_KEY => UrlSlug::create(self::VALID_URL_SLUG),
        ]);
    }
}
