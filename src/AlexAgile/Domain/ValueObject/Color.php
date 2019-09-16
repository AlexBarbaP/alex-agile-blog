<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Color
{
    private const COLOR_REGEX = '/^[A-Za-z]+$/';

    /** @var string */
    private $value;

    private function __construct(string $color)
    {
        if (!filter_var(
            $color,
            FILTER_VALIDATE_REGEXP,
            ["options" => ["regexp" => self::COLOR_REGEX]])
        ) {
            throw new InvalidArgumentException('Invalid color argument');
        }

        $this->value = $color;
    }

    public static function create(string $color): self
    {
        return new static($color);
    }

    public function color(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
