<?php
declare(strict_types=1);

namespace AlexAgile\Application\ContactRequest;

use AlexAgile\Domain\ContactRequest\ContactRequest;
use AlexAgile\Domain\ContactRequest\CreateContactRequestCommand;
use AlexAgile\Domain\ContactRequest\CreateContactRequestService;
use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Message;
use AlexAgile\Domain\ValueObject\Name;
use AlexAgile\Domain\ValueObject\Phone;

class CreateContactRequestCommandHandler
{
    /** @var CreateContactRequestService */
    private $createContactRequestService;

    public function __construct(CreateContactRequestService $createContactRequestService)
    {
        $this->createContactRequestService = $createContactRequestService;
    }

    public function handle(CreateContactRequestCommand $command): void
    {
        $email = Email::create($command->email());
        $message = Message::create($command->message());
        $name = Name::create($command->name());
        $phone = Phone::create($command->phone());

        $contactRequest = new ContactRequest($email, $message, $name, $phone);

        $this->createContactRequestService->execute([
            CreateContactRequestService::CONTACT_REQUEST_KEY => $contactRequest
        ]);
    }
}
