<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\Post\PostId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoctrinePostId extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'PostId';
    }

    /**
     * @param PostId $value
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
     * @return PostId
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return PostId::create($value);
    }
}
