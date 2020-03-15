<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ContactRequest\ContactRequestId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class DoctrineContactRequestId extends GuidType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'ContactRequestId';
    }

    /**
     * @param ContactRequestId $value
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
     * @return ContactRequestId
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return ContactRequestId::create($value);
    }
}
