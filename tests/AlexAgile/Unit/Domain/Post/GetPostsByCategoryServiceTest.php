<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\GetPostsByCategoryService;
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

class GetPostsByCategoryServiceTest extends TestCase
{
    private const CATEGORY_COLOR = 'yellow';
    private const CATEGORY_TITLE = 'category-title';
    private const CATEGORY_URL_SLUG1 = 'category-one';
    private const CATEGORY_URL_SLUG2 = 'category-two';
    private const POST_CONTENT = 'Post Content';
    private const POST_DESCRIPTION = 'Post Description';
    private const POST_ENABLED = true;
    private const POST_IMAGE = '/folder/image.jpg';
    private const VALID_ORDER = 1;
    private const VALID_TITLE = 'Post title';
    private const VALID_URL_SLUG = 'post-slug';

    /**
     * @test
     */
    public function findPostsByCategoryUrlSlug_whenPostsExist_shouldReturnAnArrayOfPosts(): void
    {
        $categoriesCollection = $this->getCategoriesCollection();

        $postArray = $this->getPostArray($categoriesCollection);

        $postRepository = new PostRepositoryInMemoryAdapter($postArray);
        $getPostsByCategoryService = new GetPostsByCategoryService($postRepository);

        /** @var Category $firstCategory */
        $firstCategory = $categoriesCollection->first();

        /** @var array $postsArray */
        $postsArray = $getPostsByCategoryService->execute([
            GetPostsByCategoryService::CATEGORY_KEY => $firstCategory,
        ]);

        $this->assertCount(2, $postsArray);
    }

    private function getCategoriesCollection(): Collection
    {
        return new ArrayCollection([
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
        ]);
    }

    private function getPostArray(Collection $categoriesCollection): array
    {
        return [
            new Post(
                $categoriesCollection,
                Content::create(self::POST_CONTENT),
                Description::create(self::POST_DESCRIPTION),
                self::POST_ENABLED,
                ImageUrl::create(self::POST_IMAGE),
                Order::create(self::VALID_ORDER),
                Title::create(self::VALID_TITLE),
                UrlSlug::create(self::VALID_URL_SLUG)
            ),
            new Post(
                $categoriesCollection,
                Content::create(self::POST_CONTENT),
                Description::create(self::POST_DESCRIPTION),
                self::POST_ENABLED,
                ImageUrl::create(self::POST_IMAGE),
                Order::create(self::VALID_ORDER),
                Title::create(self::VALID_TITLE),
                UrlSlug::create(self::VALID_URL_SLUG)
            ),
        ];
    }
}
