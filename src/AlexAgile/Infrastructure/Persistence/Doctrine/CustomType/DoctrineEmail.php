<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use AlexAgile\Domain\ValueObject\Email;

class DoctrineEmail extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Email';
    }

    /**
     * @param Email $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->email();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Email
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Email::create($value);
    }
}
