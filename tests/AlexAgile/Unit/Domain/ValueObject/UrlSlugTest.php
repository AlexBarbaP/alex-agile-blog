<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\UrlSlug;
use PHPUnit\Framework\TestCase;

class UrlSlugTest extends TestCase
{
    const VALID_URL_SLUG = 'this-is-a-valid-url-slug';
    const INVALID_URL_SLUGS = [
        [''],
        ['containing spaces'],
        ['/starting-with-backslash'],
        ['containing/backslash'],
        ['containing$dollar'],
        ['-starting-with-minus'],
    ];

    /**
     * @test
     */
    public function createUrlSlug_whenDataIsValid_shouldCreateAUrlSlugObject(): void
    {
        $this->assertInstanceOf(UrlSlug::class, UrlSlug::create(self::VALID_URL_SLUG));
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function createTitle_whenDataIsInvalid_shouldThrowAnException($value): void
    {
        UrlSlug::create($value);
    }

    public function invalidDataProvider(): array
    {
        return self::INVALID_URL_SLUGS;
    }
}
