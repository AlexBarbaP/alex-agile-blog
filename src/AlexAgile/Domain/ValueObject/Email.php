<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Email
{
    /** @var string */
    private $value;

    private function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email argument');
        }

        $this->value = $email;
    }

    public static function create(string $email = null): self
    {
        return new static($email);
    }

    public function email(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
