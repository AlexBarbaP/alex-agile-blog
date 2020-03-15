<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class Phone
{
    private const PHONE_REGEX = '/^(\+\d{15}|\+\d{14}|\+\d{13}|\+\d{12}|\+\d{11}|\d{15}|\d{14}|\d{13}|\d{12})$/';

    /** @var string */
    private $value;

    private function __construct(string $value)
    {
        $value = strtolower($value);

        if (!filter_var(
            $value,
            FILTER_VALIDATE_REGEXP,
            [
                "options" => [
                    "regexp" => self::PHONE_REGEX,
                ],
            ])
        ) {
            throw new InvalidArgumentException('Invalid phone argument');
        }

        $this->value = $value;
    }

    public static function create(string $value): self
    {
        return new static($value);
    }

    public function phone(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
