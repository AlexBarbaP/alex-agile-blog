<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class UrlSlug
{
    private const URL_SLUG_REGEX = '/^[a-z][-a-z0-9]*$/';

    /** @var string */
    private $value;

    private function __construct(string $urlSlug)
    {
        $urlSlug = strtolower($urlSlug);

        if (!filter_var(
            $urlSlug,
            FILTER_VALIDATE_REGEXP,
            [
                "options" => [
                    "regexp" => self::URL_SLUG_REGEX,
                ],
            ])
        ) {
            throw new InvalidArgumentException('Invalid url-slug argument');
        }

        $this->value = $urlSlug;
    }

    public static function create(string $urlSlug): self
    {
        return new static($urlSlug);
    }

    public function urlSlug(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
