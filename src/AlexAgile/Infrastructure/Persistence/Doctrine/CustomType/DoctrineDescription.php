<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Description;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class DoctrineDescription extends TextType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Description';
    }

    /**
     * @param Description $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->description();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Description
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Description::create($value);
    }
}
