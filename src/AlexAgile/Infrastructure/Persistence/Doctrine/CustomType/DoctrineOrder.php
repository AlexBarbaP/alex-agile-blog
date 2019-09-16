<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\CustomType;

use AlexAgile\Domain\ValueObject\Order;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

class DoctrineOrder extends IntegerType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Order';
    }

    /**
     * @param Order $value
     * @param AbstractPlatform $platform
     *
     * @return string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->order();
    }

    /**
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return Order
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return Order::create((int)$value);
    }
}
