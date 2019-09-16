<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\ImageUrl;
use PHPUnit\Framework\TestCase;

class ImageUrlTest extends TestCase
{
    const VALID_IMAGE_URLS = [
        ['this-is-a-valid-image-url.jpg'],
        ['this-is-a-valid-image-url.gif'],
        ['this-is-a-valid-image-url.png'],
        ['/folder/this-is-a-valid-image-url.jpg'],
        ['folder/this-is-a-valid-image-url.gif'],
        ['/folder/folder/this-is-a-valid-image-url.png'],
    ];

    const INVALID_IMAGE_URLS = [
        [''],
        ['with-out-extension'],
        ['with empty spaces.png'],
        ['containing$dollar'],
        ['-starting-with-minus'],
    ];

    /**
     * @dataProvider validDataProvider
     * @test
     */
    public function createImageUrl_whenDataIsValid_shouldCreateAImageUrlObject(string $value): void
    {
        $this->assertInstanceOf(ImageUrl::class, ImageUrl::create($value));
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function createTitle_whenDataIsInvalid_shouldThrowAnException(string $value): void
    {
        ImageUrl::create($value);
    }

    public function validDataProvider(): array
    {
        return self::VALID_IMAGE_URLS;
    }

    public function invalidDataProvider(): array
    {
        return self::INVALID_IMAGE_URLS;
    }
}
