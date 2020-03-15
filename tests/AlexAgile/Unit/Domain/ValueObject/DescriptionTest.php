<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Description;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    const VALID_DESCRIPTION = 'This is a valid description';
    const INVALID_DESCRIPTION = '';

    /**
     * @test
     */
    public function createDescription_whenDataIsValid_shouldCreateADescriptionObject(): void
    {
        $this->assertInstanceOf(Description::class, Description::create(self::VALID_DESCRIPTION));
    }

    /**
     * @test
     */
    public function createDescription_whenDataIsInvalid_shouldThrowAnException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Description::create(self::INVALID_DESCRIPTION);
    }
}
