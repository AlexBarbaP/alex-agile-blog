<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DoctrineEmail extends StringType
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
