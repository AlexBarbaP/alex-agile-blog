<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\ImageUrl;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class DoctrineImageUrl extends TextType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'ImageUrl';
    }

    /**
     * @param ImageUrl $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->imageUrl();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return ImageUrl
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ImageUrl::create($value);
    }
}
