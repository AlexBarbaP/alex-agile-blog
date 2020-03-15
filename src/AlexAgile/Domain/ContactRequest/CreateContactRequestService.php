<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ContactRequest;

use League\Event\EmitterInterface;
use Ramsey\Uuid\Uuid;

class CreateContactRequestService
{
    public const CONTACT_REQUEST_KEY = 'contact-request';

    /** @var ContactRequestRepositoryInterface */
    private $contactRequestRepository;

    /** @var EmitterInterface */
    private $eventBus;

    public function __construct(ContactRequestRepositoryInterface $contactRequestRepository, EmitterInterface $eventBus)
    {
        $this->contactRequestRepository = $contactRequestRepository;
        $this->eventBus = $eventBus;
    }

    public function execute(array $options = []): void
    {
        /** @var ContactRequest $contactRequest */
        $contactRequest = $options[self::CONTACT_REQUEST_KEY];

        $this->contactRequestRepository->save($contactRequest);

        $this->eventBus->emit(new ContactRequestCreatedEvent(
            Uuid::uuid4()->toString(),
            $contactRequest->getId()
        ));
    }
}
