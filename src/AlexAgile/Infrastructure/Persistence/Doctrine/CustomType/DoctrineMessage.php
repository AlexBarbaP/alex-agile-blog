<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Message;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

class DoctrineMessage extends TextType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Message';
    }

    /**
     * @param Message $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->message();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Message
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Message::create($value);
    }
}
