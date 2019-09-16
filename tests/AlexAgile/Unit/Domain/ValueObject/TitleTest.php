<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    const VALID_TITLE = 'This is a valid title';
    const INVALID_TITLE = '';

    /**
     * @test
     */
    public function createTitle_whenDataIsValid_shouldCreateATitleObject(): void
    {
        $this->assertInstanceOf(Title::class, Title::create(self::VALID_TITLE));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createTitle_whenDataIsInvalid_shouldThrowAnException(): void
    {
        Title::create(self::INVALID_TITLE);
    }
}
