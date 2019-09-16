<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\UrlSlug;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DoctrineUrlSlug extends StringType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'UrlSlug';
    }

    /**
     * @param UrlSlug $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->urlSlug();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return UrlSlug
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return UrlSlug::create($value);
    }
}
