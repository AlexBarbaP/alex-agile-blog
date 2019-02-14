<?php
declare(strict_types=1);

namespace Growonic\Domain\ValueObject;

use InvalidArgumentException;

final class Password
{
    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        if (strlen($value) < 4) {
            throw new InvalidArgumentException('Invalid password argument');
        }

        $this->value = $value;
    }

    public static function create(string $password = null): self
    {
        return new static($password);
    }

    public function password(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
