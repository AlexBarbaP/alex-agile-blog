<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    const VALID_NAME = 'This is a valid name';
    const INVALID_NAME = '';

    /**
     * @test
     */
    public function createName_whenDataIsValid_shouldCreateANameObject(): void
    {
        $this->assertInstanceOf(Name::class, Name::create(self::VALID_NAME));
    }

    /**
     * @test
     */
    public function createName_whenDataIsInvalid_shouldThrowAnException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Name::create(self::INVALID_NAME);
    }
}
