<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{
    private const VALID_COLOR = 'blue';
    private const INVALID_COLOR = 'color-with-spaces';

    /**
     * @test
     */
    public function createColor_whenDataIsValid_shouldCreateAColorObject(): void
    {
        $this->assertInstanceOf(Color::class, Color::create(self::VALID_COLOR));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createColor_whenDataIsInvalid_shouldThrowAnException(): void
    {
        Color::create(self::INVALID_COLOR);
    }
}
