<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\ContactRequest;

use AlexAgile\Domain\ContactRequest\CreateContactRequestCommand;
use AlexAgile\Tests\Integration\IntegrationTestAbstract;

class CreateContactRequestTest extends IntegrationTestAbstract
{
    private const VALID_EMAIL = 'valid@email.com';
    private const VALID_MESSAGE = 'This is a valid message.';
    private const VALID_NAME = 'Valid Name';

    /**
     * @test
     */
    public function createContactRequest_whenDataIsValid_shouldAddANewContactRequestToStorage(): void
    {
        $this->assertCount(1, $this->contactRequestRepositoryDoctrineAdapter->findAll());

        $createContactRequestCommand = new CreateContactRequestCommand(
            self::VALID_EMAIL,
            self::VALID_MESSAGE,
            self::VALID_NAME
        );
        $this->commandBus->handle($createContactRequestCommand);

        $this->assertCount(2, $this->contactRequestRepositoryDoctrineAdapter->findAll());
    }
}
