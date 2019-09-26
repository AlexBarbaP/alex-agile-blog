<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Fixture\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Order;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineCategoryFixtureLoader extends Fixture
{
    public const CATEGORY_1_COLOR = 'yellow';
    public const CATEGORY_1_ORDER = 1;
    public const CATEGORY_1_TITLE = 'first-category-title';
    public const CATEGORY_1_URL_SLUG = 'category-one';

    public const CATEGORY_REFERENCE = 'category';

    public const CATEGORY_2_COLOR = 'blue';
    public const CATEGORY_2_ORDER = 2;
    public const CATEGORY_2_TITLE = 'second-category-title';
    public const CATEGORY_2_URL_SLUG = 'category-two';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $firstCategory = new Category(
            Color::create(self::CATEGORY_1_COLOR),
            Order::create(self::CATEGORY_1_ORDER),
            Title::create(self::CATEGORY_1_TITLE),
            UrlSlug::create(self::CATEGORY_1_URL_SLUG)
        );

        $secondCategory = new Category(
            Color::create(self::CATEGORY_2_COLOR),
            Order::create(self::CATEGORY_2_ORDER),
            Title::create(self::CATEGORY_2_TITLE),
            UrlSlug::create(self::CATEGORY_2_URL_SLUG)
        );

        $manager->persist($firstCategory);
        $manager->persist($secondCategory);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE, $firstCategory);
    }
}
