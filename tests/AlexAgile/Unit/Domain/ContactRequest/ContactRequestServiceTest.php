<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Unit\Domain\ContactRequest;

use AlexAgile\Application\ContactRequest\ContactRequestCreatedEventListener;
use AlexAgile\Domain\ContactRequest\ContactRequest;
use AlexAgile\Domain\ContactRequest\CreateContactRequestService;
use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Message;
use AlexAgile\Domain\ValueObject\Name;
use AlexAgile\Domain\ValueObject\Phone;
use AlexAgile\Infrastructure\Messaging\EventBus\InMemory\InMemoryEventBus;
use AlexAgile\Infrastructure\Persistence\InMemory\ContactRequest\ContactRequestRepositoryInMemoryAdapter;
use League\Event\EmitterInterface;
use PHPUnit\Framework\TestCase;

class ContactRequestServiceTest extends TestCase
{
    private const EVENT_CONTACT_REQUEST_CREATED = 'Event.ContactRequest.Created';
    private const VALID_EMAIL = 'valid@email.com';
    private const VALID_MESSAGE = 'This is a valid message.';
    private const VALID_NAME = 'Valid Name';
    private const VALID_PHONE = '+31612123123';

    /**
     * @test
     */
    public function createContactRequest_whenDataIsValid_shouldAddAContactRequestToStorage(): void
    {
        $contactRequest = new ContactRequest(
            Email::create(self::VALID_EMAIL),
            Message::create(self::VALID_MESSAGE),
            Name::create(self::VALID_NAME),
            Phone::create(self::VALID_PHONE)
        );

        $contactRequestRepository = new ContactRequestRepositoryInMemoryAdapter([]);
        $inMemoryEventBus = new InMemoryEventBus();
        $createContactRequestService = new CreateContactRequestService($contactRequestRepository, $inMemoryEventBus);

        $createContactRequestService->execute([
            CreateContactRequestService::CONTACT_REQUEST_KEY => $contactRequest
        ]);

        $this->assertCount(1, $contactRequestRepository->findAll());
    }

    /**
     * @test
     */
    public function createContactRequest_whenContactRequestIsCreated_shouldEmitAContactRequestCreatedEvent(): void
    {
        $contactRequest = new ContactRequest(
            Email::create(self::VALID_EMAIL),
            Message::create(self::VALID_MESSAGE),
            Name::create(self::VALID_NAME),
            Phone::create(self::VALID_PHONE)
        );

        $contactRequestRepository = new ContactRequestRepositoryInMemoryAdapter([]);
        $inMemoryEventBus = $this->getInMemoryEventBus();
        $createContactRequestService = new CreateContactRequestService($contactRequestRepository, $inMemoryEventBus);

        $createContactRequestService->execute([
            CreateContactRequestService::CONTACT_REQUEST_KEY => $contactRequest
        ]);
    }

    private function getInMemoryEventBus(): EmitterInterface
    {
        $inMemoryEventBus = new InMemoryEventBus();

        $mockContactRequestCreatedEventListener = $this->getMockBuilder(ContactRequestCreatedEventListener::class)
            ->disableOriginalConstructor()
            ->setMethods(['handle'])
            ->getMock();

        $mockContactRequestCreatedEventListener->expects($this->once())
            ->method('handle');

        $inMemoryEventBus->addListener(self::EVENT_CONTACT_REQUEST_CREATED, $mockContactRequestCreatedEventListener);

        return $inMemoryEventBus;
    }
}
