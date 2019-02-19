<?php
declare(strict_types=1);

namespace Growonic\Infrastructure\Persistence\Doctrine\CustomType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Growonic\Domain\ValueObject\Password;

class DoctrinePassword extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Password';
    }

    /**
     * @param Password $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->password();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Password
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Password::create($value);
    }
}
