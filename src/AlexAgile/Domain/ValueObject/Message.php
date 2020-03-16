<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Message
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Please, provide a message!');
        }

        $this->value = htmlentities($value, ENT_QUOTES, 'UTF-8');
    }

    public static function create(string $value): self
    {
        return new static($value);
    }

    public function message(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
