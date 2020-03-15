<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Phone;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DoctrinePhone extends StringType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Phone';
    }

    /**
     * @param Phone $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->phone();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Phone
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Phone::create($value);
    }
}
