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

    /** @var string */
    private $phone = '';

    public function __construct(string $email, string $message, string $name, string $phone)
    {
        $this->email = $email;
        $this->message = $message;
        $this->name = $name;
        $this->phone = $phone;
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

    public function phone(): string
    {
        return $this->phone;
    }
}
