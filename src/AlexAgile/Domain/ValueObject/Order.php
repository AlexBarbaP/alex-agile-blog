<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Order
{
    /** @var string */
    private $value;

    private function __construct(int $order)
    {
        if ($order < 1) {
            throw new InvalidArgumentException('Invalid order argument');
        }

        $this->value = $order;
    }

    public static function create(int $order): self
    {
        return new static($order);
    }

    public function order(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
