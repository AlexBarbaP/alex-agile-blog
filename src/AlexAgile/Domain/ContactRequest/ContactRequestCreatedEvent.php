<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ContactRequest;

use AlexAgile\Domain\Event\EventAbstract;

final class ContactRequestCreatedEvent extends EventAbstract
{
    /** @var ContactRequestId */
    private $contactRequestId;

    public function __construct(string $id, ContactRequestId $contactRequestId)
    {
        parent::__construct($id);

        $this->contactRequestId = $contactRequestId;
    }

    public function getName(): string
    {
        return 'Event.ContactRequest.Created';
    }

    public function contactRequestId(): ContactRequestId
    {
        return $this->contactRequestId;
    }
}
