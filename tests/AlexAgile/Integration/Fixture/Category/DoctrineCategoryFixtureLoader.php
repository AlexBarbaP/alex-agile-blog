<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Fixture\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineCategoryFixtureLoader extends Fixture
{
    private const CATEGORY_COLOR = 'pink';
    private const CATEGORY_TITLE = 'category-title';
    private const CATEGORY_URL_SLUG = 'category';

    public const CATEGORY_REFERENCE = 'category';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category(
            Color::create(self::CATEGORY_COLOR),
            Title::create(self::CATEGORY_TITLE),
            UrlSlug::create(self::CATEGORY_URL_SLUG)
        );

        $manager->persist($category);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE, $category);
    }
}
