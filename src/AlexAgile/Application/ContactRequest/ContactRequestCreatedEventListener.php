<?php
declare(strict_types=1);

namespace AlexAgile\Application\ContactRequest;

use AlexAgile\Domain\ContactRequest\ContactRequestRepositoryInterface;
use AlexAgile\Domain\Notification\NotificationServiceInterface;
use League\Event\EventInterface;
use League\Event\ListenerInterface;

class ContactRequestCreatedEventListener implements ListenerInterface
{
    /** @var ContactRequestRepositoryInterface */
    private $contactRequestRepository;

    /** @var NotificationServiceInterface */
    private $notificationService;

    public function __construct(ContactRequestRepositoryInterface $contactRequestRepository, NotificationServiceInterface $notificationService)
    {
        $this->contactRequestRepository = $contactRequestRepository;
        $this->notificationService = $notificationService;
    }

    public function handle(EventInterface $event): void
    {
        $contactRequest = $this->contactRequestRepository->find($event->contactRequestId());

        $this->notificationService->notify($contactRequest);
    }

    /**
     * @inheritdoc
     */
    public function isListener($listener)
    {
        return $listener === $this;
    }
}
