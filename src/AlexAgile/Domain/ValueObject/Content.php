<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Content
{
    /** @var string */
    private $value;

    private function __construct(string $title)
    {
        if (empty($title)) {
            throw new InvalidArgumentException('Invalid content argument');
        }

        $this->value = $title;
    }

    public static function create(string $title): self
    {
        return new static($title);
    }

    public function content(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
