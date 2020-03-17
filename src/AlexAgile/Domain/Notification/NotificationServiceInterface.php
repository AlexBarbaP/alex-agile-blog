<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Notification;

use AlexAgile\Domain\ContactRequest\ContactRequest;

interface NotificationServiceInterface
{
    public function notify(ContactRequest $contactRequest): bool;
}
