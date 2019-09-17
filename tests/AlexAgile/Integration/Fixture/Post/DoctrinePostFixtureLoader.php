<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Fixture\Post;

use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\ValueObject\Content;
use AlexAgile\Domain\ValueObject\Description;
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
    public const POST1_CONTENT = 'Post One Content';
    public const POST1_DESCRIPTION = 'Post One Description';
    public const POST1_ENABLED = true;
    public const POST1_IMAGE = '/folder1/image.jpg';
    public const POST1_ORDER = 1;
    public const POST1_TITLE = 'Post one title';
    public const POST1_URL_SLUG = 'post-one-url-slug';

    public const POST2_CONTENT = 'Post Two Content';
    public const POST2_DESCRIPTION = 'Post Two Description';
    public const POST2_ENABLED = false;
    public const POST2_IMAGE = '/folder2/image.jpg';
    public const POST2_ORDER = 2;
    public const POST2_TITLE = 'Post two title';
    public const POST2_URL_SLUG = 'post-two-url-slug';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $category = $this->getReference(DoctrineCategoryFixtureLoader::CATEGORY_REFERENCE);

        $postEnabled = new Post(
            new ArrayCollection([$category]),
            Content::create(self::POST1_CONTENT),
            Description::create(self::POST1_DESCRIPTION),
            self::POST1_ENABLED,
            ImageUrl::create(self::POST1_IMAGE),
            Order::create(self::POST1_ORDER),
            Title::create(self::POST1_TITLE),
            UrlSlug::create(self::POST1_URL_SLUG)
        );
        $postDisabled = new Post(
            new ArrayCollection([$category]),
            Content::create(self::POST2_CONTENT),
            Description::create(self::POST2_DESCRIPTION),
            self::POST2_ENABLED,
            ImageUrl::create(self::POST2_IMAGE),
            Order::create(self::POST2_ORDER),
            Title::create(self::POST2_TITLE),
            UrlSlug::create(self::POST2_URL_SLUG)
        );

        $manager->persist($postEnabled);
        $manager->persist($postDisabled);
        $manager->flush();
    }
}
