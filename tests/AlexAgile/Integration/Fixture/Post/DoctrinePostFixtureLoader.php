<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Fixture\Post;

use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\ValueObject\Content;
use AlexAgile\Domain\ValueObject\ImageUrl;
use AlexAgile\Domain\ValueObject\Order;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use AlexAgile\Tests\Integration\Fixture\Category\DoctrineCategoryFixtureLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrinePostFixtureLoader extends Fixture
{
    private const POST_CONTENT = 'Post Content';
    private const POST_ENABLED = true;
    private const POST_IMAGE = '/folder/image.jpg';
    private const POST_ORDER = 1;
    private const POST_TITLE = 'Post title';
    private const POST_URL_SLUG = 'post-slug';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $category = $this->getReference(DoctrineCategoryFixtureLoader::CATEGORY_REFERENCE);

        $post = new Post(
            new ArrayCollection([$category]),
            Content::create(self::POST_CONTENT),
            self::POST_ENABLED,
            ImageUrl::create(self::POST_IMAGE),
            Order::create(self::POST_ORDER),
            Title::create(self::POST_TITLE),
            UrlSlug::create(self::POST_URL_SLUG)
        );

        $manager->persist($post);
        $manager->flush();
    }
}
