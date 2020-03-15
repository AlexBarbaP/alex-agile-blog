<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Content;
use PHPUnit\Framework\TestCase;

class ContentTest extends TestCase
{
    const VALID_CONTENT = 'This is a valid content';
    const INVALID_CONTENT = '';

    /**
     * @test
     */
    public function createContent_whenDataIsValid_shouldCreateAContentObject(): void
    {
        $this->assertInstanceOf(Content::class, Content::create(self::VALID_CONTENT));
    }

    /**
     * @test
     */
    public function createContent_whenDataIsInvalid_shouldThrowAnException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Content::create(self::INVALID_CONTENT);
    }
}
