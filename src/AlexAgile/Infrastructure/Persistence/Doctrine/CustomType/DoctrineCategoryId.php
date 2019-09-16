<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\Category\CategoryId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoctrineCategoryId extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'CategoryId';
    }

    /**
     * @param CategoryId $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->id();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return CategoryId
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return CategoryId::create($value);
    }
}
