<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Name;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class DoctrineName extends TextType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Name';
    }

    /**
     * @param Name $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->name();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Name
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Name::create($value);
    }
}
