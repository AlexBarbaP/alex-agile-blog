<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Content;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BlobType;

class DoctrineContent extends BlobType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Content';
    }

    /**
     * @param Content $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->content();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Content
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Content::create($value);
    }
}
