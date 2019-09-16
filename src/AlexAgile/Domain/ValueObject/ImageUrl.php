<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ValueObject;

use InvalidArgumentException;

final class ImageUrl
{
    private const IMAGE_URL_REGEX = '/^[^?!\s]*\.(jpg|jpeg|gif|png)(?![\w.\-_])/';

    /** @var string */
    private $value;

    private function __construct(string $imageUrl)
    {
        $imageUrl = strtolower($imageUrl);

        if (!filter_var(
            $imageUrl,
            FILTER_VALIDATE_REGEXP,
            [
                "options" => [
                    "regexp" => self::IMAGE_URL_REGEX,
                ],
            ])
        ) {
            throw new InvalidArgumentException('Invalid image-url argument');
        }

        $this->value = $imageUrl;
    }

    public static function create(string $imageUrl): self
    {
        return new static($imageUrl);
    }

    public function imageUrl(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
