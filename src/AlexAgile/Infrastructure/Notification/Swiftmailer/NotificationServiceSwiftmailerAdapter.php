<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Notification\Swiftmailer;

use AlexAgile\Domain\ContactRequest\ContactRequest;
use AlexAgile\Domain\Notification\NotificationServiceInterface;
use Swift_Mailer;

final class NotificationServiceSwiftmailerAdapter implements NotificationServiceInterface
{
    private const EMAIL_FROM = 'alex@alexbarbacoaching.com';
    private const EMAIL_TO = 'alex@alexbarbacoaching.com';
    private const EMAIL_SUBJECT = 'Alex Barba Coaching - Contact Request Received';

    /** @var Swift_Mailer */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(ContactRequest $contactRequest): bool
    {
        $message = (new \Swift_Message(self::EMAIL_SUBJECT))
            ->setFrom(self::EMAIL_FROM)
            ->setTo(self::EMAIL_TO)
            ->setBody($this->generateEmailBody($contactRequest), 'text/html')
        ;

        return (bool)$this->mailer->send($message);
    }

    private function generateEmailBody(ContactRequest $contactRequest): string
    {
        $body = <<< EOD
<b>Contact Request:</b> <br>
Name: {$contactRequest->getName()}<br>
Email: {$contactRequest->getEmail()}<br>
Phone: {$contactRequest->getPhone()}<br>
Message: <br>
{$contactRequest->getMessage()}
EOD;
        return $body;
    }
}
