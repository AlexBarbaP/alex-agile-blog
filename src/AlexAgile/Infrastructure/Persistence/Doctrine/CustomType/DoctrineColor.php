<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Color;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DoctrineColor extends StringType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Color';
    }

    /**
     * @param Color $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->color();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Color
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Color::create($value);
    }
}
