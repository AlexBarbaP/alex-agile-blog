<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    const VALID_PHONES = [
        ['+31061212312312'],
        ['+3106121231231'],
        ['+310612123123'],
        ['+31612123123'],
        ['003161212312312'],
        ['00316121231231'],
        ['0031612123123'],
    ];

    const INVALID_PHONES = [
        [''],
        ['+31A612123123'],
        ['+310612123123+'],
        ['A310612123123'],
    ];

    /**
     * @test
     * @dataProvider validDataProvider
     */
    public function createPhone_whenDataIsValid_shouldCreateAPhoneObject($value): void
    {
        $this->assertInstanceOf(Phone::class, Phone::create($value));
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function createTitle_whenDataIsInvalid_shouldThrowAnException($value): void
    {
        Phone::create($value);
    }

    public function validDataProvider(): array
    {
        return self::VALID_PHONES;
    }

    public function invalidDataProvider(): array
    {
        return self::INVALID_PHONES;
    }
}
