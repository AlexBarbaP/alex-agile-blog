<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Messaging\EventBus\League;

use AlexAgile\Application\ContactRequest\ContactRequestCreatedEventListener;
use AlexAgile\Domain\ContactRequest\ContactRequestRepositoryInterface;
use AlexAgile\Infrastructure\Notification\Swiftmailer\NotificationServiceSwiftmailerAdapter;
use League\Event\Emitter;
use League\Event\EmitterInterface;

final class LeagueEventBusFactory
{
    /** @var EmitterInterface */
    private $emitter;

    public function __construct(ContactRequestRepositoryInterface $contactRequestRepository, NotificationServiceSwiftmailerAdapter $notificationService)
    {
        $this->emitter = new Emitter();

        $this->emitter->addListener('Event.ContactRequest.Created', new ContactRequestCreatedEventListener($contactRequestRepository, $notificationService));
    }

    public function create(): EmitterInterface
    {
        return $this->emitter;
    }
}
