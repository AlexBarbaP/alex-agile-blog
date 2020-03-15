<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Name
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Invalid name argument');
        }

        $this->value = $value;
    }

    public static function create(string $value): self
    {
        return new static($value);
    }

    public function name(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
