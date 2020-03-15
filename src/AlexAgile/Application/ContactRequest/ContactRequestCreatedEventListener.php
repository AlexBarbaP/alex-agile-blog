<?php
declare(strict_types=1);

namespace AlexAgile\Application\ContactRequest;

use AlexAgile\Domain\ContactRequest\ContactRequestRepositoryInterface;
use League\Event\EventInterface;
use League\Event\ListenerInterface;

class ContactRequestCreatedEventListener implements ListenerInterface
{
    /** @var ContactRequestRepositoryInterface */
    private $contactRequestRepository;

    public function __construct(ContactRequestRepositoryInterface $contactRequestRepository)
    {
        $this->contactRequestRepository = $contactRequestRepository;
    }

    public function handle(EventInterface $event): void
    {
        // TODO
    }

    /**
     * @inheritdoc
     */
    public function isListener($listener)
    {
        return $listener === $this;
    }
}
