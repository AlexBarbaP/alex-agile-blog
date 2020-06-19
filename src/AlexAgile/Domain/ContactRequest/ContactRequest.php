<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ContactRequest;

use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Message;
use AlexAgile\Domain\ValueObject\Name;
use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

class ContactRequest
{
    /** @var ContactRequestId */
    private $id;

    /** @var DateTimeImmutable */
    private $created;

    /** @var Email */
    private $email = '';

    /** @var Message */
    private $message = '';

    /** @var DateTimeImmutable */
    private $modified;

    /** @var Name */
    private $name = '';

    /**
     * @throws Exception
     * @throws InvalidUuidStringException
     */
    public function __construct(
        Email $email,
        Message $message,
        Name $name,
        ContactRequestId $contactRequestId = null,
        DateTimeImmutable $created = null,
        DateTimeImmutable $modified = null
    ) {
        $this->id = $contactRequestId ?: ContactRequestId::create();
        $this->email = $email;
        $this->message = $message;
        $this->name = $name;
        $this->created = $created ?: new DateTimeImmutable();
        $this->modified = $modified ?: new DateTimeImmutable();
    }

    public function getId(): ContactRequestId
    {
        return $this->id;
    }

    public function getCreated(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($this->created);
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function getModified(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($this->modified);
    }

    public function getName(): Name
    {
        return $this->name;
    }
}
