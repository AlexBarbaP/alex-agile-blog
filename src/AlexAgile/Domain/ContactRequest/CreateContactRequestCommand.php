<?php
declare(strict_types=1);

namespace AlexAgile\Domain\ContactRequest;

class CreateContactRequestCommand
{
    /** @var string */
    private $email = '';

    /** @var string */
    private $message = '';

    /** @var string */
    private $name = '';

    public function __construct(string $email, string $message, string $name)
    {
        $this->email = $email;
        $this->message = $message;
        $this->name = $name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function name(): string
    {
        return $this->name;
    }
}
