<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    const VALID_ORDER = 1;
    const INVALID_ORDERS = [
        [0],
        [-1],
    ];

    /**
     * @test
     */
    public function createOrder_whenDataIsValid_shouldCreateAOrderObject(): void
    {
        $this->assertInstanceOf(Order::class, Order::create(self::VALID_ORDER));
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     */
    public function createTitle_whenDataIsInvalid_shouldThrowAnException($value): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Order::create($value);
    }

    public function invalidDataProvider(): array
    {
        return self::INVALID_ORDERS;
    }
}
