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
    private const POST_CONTENT = 'Post Content';
    private const POST_DESCRIPTION = 'Post Description';
    private const POST_ENABLED = true;
    private const POST_DISABLED = false;
    private const POST_IMAGE = '/folder/image.jpg';
    private const POST_ORDER = 1;
    private const POST_TITLE = 'Post title';
    private const POST_ENABLED_URL_SLUG = 'post-enabled-slug';
    private const POST_DISABLED_URL_SLUG = 'post-disabled-slug';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $category = $this->getReference(DoctrineCategoryFixtureLoader::CATEGORY_REFERENCE);

        $postEnabled = new Post(
            new ArrayCollection([$category]),
            Content::create(self::POST_CONTENT),
            Description::create(self::POST_DESCRIPTION),
            self::POST_ENABLED,
            ImageUrl::create(self::POST_IMAGE),
            Order::create(self::POST_ORDER),
            Title::create(self::POST_TITLE),
            UrlSlug::create(self::POST_ENABLED_URL_SLUG)
        );
        $postDisabled = new Post(
            new ArrayCollection([$category]),
            Content::create(self::POST_CONTENT),
            Description::create(self::POST_DESCRIPTION),
            self::POST_DISABLED,
            ImageUrl::create(self::POST_IMAGE),
            Order::create(self::POST_ORDER),
            Title::create(self::POST_TITLE),
            UrlSlug::create(self::POST_DISABLED_URL_SLUG)
        );

        $manager->persist($postEnabled);
        $manager->persist($postDisabled);
        $manager->flush();
    }
}
