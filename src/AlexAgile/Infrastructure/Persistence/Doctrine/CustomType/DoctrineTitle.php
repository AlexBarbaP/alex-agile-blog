<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Title;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class DoctrineTitle extends TextType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Title';
    }

    /**
     * @param Title $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->title();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Title
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Title::create($value);
    }
}
