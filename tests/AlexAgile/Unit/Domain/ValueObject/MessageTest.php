<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ValueObject;

use AlexAgile\Domain\ValueObject\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    const VALID_MESSAGE = 'This is a valid message';
    const INVALID_MESSAGE = '';
    const HTML_MESSAGE = '<script>This is a valid message</script>';

    /**
     * @test
     */
    public function createMessage_whenDataIsValid_shouldCreateAMessageObject(): void
    {
        $this->assertInstanceOf(Message::class, Message::create(self::VALID_MESSAGE));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createMessage_whenDataIsInvalid_shouldThrowAnException(): void
    {
        Message::create(self::INVALID_MESSAGE);
    }

    /**
     * @test
     */
    public function createMessage_whenDataContainsHtml_shouldCreateAMessageObjectWithEscapedContent(): void
    {
        $message = Message::create(self::HTML_MESSAGE);
        $this->assertSame('&lt;script&gt;This is a valid message&lt;/script&gt;', $message->message());
    }
}
